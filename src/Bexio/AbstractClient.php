<?php

namespace Bexio;

use Jumbojett\OpenIDConnectClient;

abstract class AbstractClient
{
    const PROVIDER_URL = 'https://idp.bexio.com';

    const API_URL = 'https://api.bexio.com';

    const API_DEFAULT_VERSION = '2.0';

    const METHOD_GET = 'GET';

    const METHOD_POST = 'POST';

    const METHOD_PUT = 'PUT';

    const METHOD_DELETE = 'DELETE';

    const METHOD_PATCH = 'PATCH';

    private ?string $accessToken = null;

    private ?string $refreshToken = null;

    public function __construct(
        public string $clientId,
        public string $clientSecret
    ) {
    }

    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    public function setRefreshToken(string $refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    public function persistTokens(string $tokensFile): bool
    {
        return false !== file_put_contents($tokensFile, json_encode([
            'accessToken' => $this->getAccessToken(),
            'refreshToken' => $this->getRefreshToken(),
        ]));
    }

    public function loadTokens(string $tokensFile)
    {
        if (! file_exists($tokensFile)) {
            throw new \Exception('Tokens file not found: ' . $tokensFile);
        }
        $tokens = json_decode(file_get_contents($tokensFile));

        $this->setAccessToken($tokens->accessToken);
        $this->setRefreshToken($tokens->refreshToken);

        // Refresh access token if it is expired
        if ($this->isAccessTokenExpired()) {
            $this->refreshToken();
            $this->persistTokens($tokensFile);
        }
    }

    public function getOpenIDConnectClient(): OpenIDConnectClient
    {
        $oidc = new OpenIDConnectClient(
            self::PROVIDER_URL,
            $this->clientId,
            $this->clientSecret
        );
        $oidc->setAccessToken($this->accessToken);
        return $oidc;
    }

    public function authenticate(string|array $scopes, string $redirectUrl)
    {
        if (! is_array($scopes)) {
            $scopes = explode(' ', $scopes);
        }

        $oidc = $this->getOpenIDConnectClient();
        $oidc->setRedirectURL($redirectUrl);
        $oidc->addScope($scopes);
        $oidc->authenticate();

        $this->setAccessToken($oidc->getAccessToken());
        $this->setRefreshToken($oidc->getRefreshToken());
    }

    public function isAccessTokenExpired($gracePeriod = 30): bool
    {
        if (! $this->accessToken) {
            return true;
        }
        $payload = $this->getOpenIDConnectClient()->getAccessTokenPayload();
        $expiry = $payload->exp ?? 0;
        return time() > ($expiry - $gracePeriod);
    }

    public function refreshToken()
    {
        $oidc = $this->getOpenIDConnectClient();
        $oidc->refreshToken($this->getRefreshToken());
        $this->setAccessToken($oidc->getAccessToken());
        $this->setRefreshToken($oidc->getRefreshToken());
    }

    public function getFullApiUrl(string $path = '', array $query = []): string
    {
        // prefix path with default API version if there was no version provided
        return implode('/', array_filter([
            self::API_URL,
            1 === preg_match('/\d\.\d\//', $path) ? '' : self::API_DEFAULT_VERSION,
            empty($query) ? $path : $path . '?' . http_build_query($query),
        ]));
    }

    abstract public function get(string $path, array $queryParams = []);

    abstract public function post(string $path, array $data = [], array $queryParams = []);

    abstract public function put(string $path, array $data = [], array $queryParams = []);

    abstract public function delete(string $path, array $data = [], array $queryParams = []);

    abstract public function patch(string $path, array $data = [], array $queryParams = []);
}
