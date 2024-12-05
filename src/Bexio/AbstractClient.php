<?php

namespace Bexio;

use Bexio\Exception\BexioClientException;
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

    private array $scopes = [];

    public function __construct(
        public string $clientId,
        public string $clientSecret
    ) {}

    public function setAccessToken(string $accessToken): self
    {
        $this->accessToken = $accessToken;
        return $this;
    }

    public function getAccessToken(): ?string
    {
        return $this->accessToken;
    }

    public function setRefreshToken(string $refreshToken): self
    {
        $this->refreshToken = $refreshToken;
        return $this;
    }

    public function getRefreshToken(): ?string
    {
        return $this->refreshToken;
    }

    public function setScopes(array|string $scopes): self
    {
        $this->scopes = is_array($scopes) ? $scopes : explode(' ', $scopes);
        return $this;
    }

    public function getScopes(): array
    {
        return $this->scopes;
    }

    public function persistTokens(string $tokensFile): bool
    {
        return file_put_contents($tokensFile, json_encode([
            'accessToken' => $this->getAccessToken(),
            'refreshToken' => $this->getRefreshToken(),
            'scope' => implode(' ', $this->getScopes()),
        ])) !== false;
    }

    public function loadTokens(string $tokensFile): self
    {
        if (! file_exists($tokensFile)) {
            throw new \Exception('Tokens file not found: '.$tokensFile);
        }
        $tokens = json_decode(file_get_contents($tokensFile));

        $this->setAccessToken($tokens->accessToken);
        $this->setRefreshToken($tokens->refreshToken);
        $this->setScopes($tokens->scope ?? []);

        // Refresh access token if it is expired
        if ($this->isAccessTokenExpired()) {
            $this->refreshToken();
            $this->persistTokens($tokensFile);
        }

        return $this;
    }

    public function getOpenIDConnectClient(): OpenIDConnectClient
    {
        $oidc = new OpenIDConnectClient(
            self::PROVIDER_URL,
            $this->clientId,
            $this->clientSecret
        );
        $oidc->addScope($this->scopes);
        $oidc->setAccessToken($this->accessToken);
        return $oidc;
    }

    public function authenticate(string|array $scopes, string $redirectUrl): self
    {
        $this->setScopes($scopes);

        $oidc = $this->getOpenIDConnectClient();
        $oidc->setRedirectURL($redirectUrl);
        $oidc->authenticate();

        $this->setAccessToken($oidc->getAccessToken());
        $this->setRefreshToken($oidc->getRefreshToken());
        $this->setScopes($oidc->getScopes());

        return $this;
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

    public function refreshToken(): self
    {
        $oidc = $this->getOpenIDConnectClient();
        $json = $oidc->refreshToken($this->getRefreshToken());
        if ($json->error ?? null) {
            throw new BexioClientException("$json->error: ".($json->error_description ?? '(no description)'));
        }
        $this->setAccessToken($oidc->getAccessToken());
        $this->setRefreshToken($oidc->getRefreshToken());
        $this->setScopes($oidc->getScopes());
        return $this;
    }

    public function getFullApiUrl(string $path = '', array $query = []): string
    {
        // prefix path with default API version if there was no version provided
        return implode('/', array_filter([
            self::API_URL,
            preg_match('/\d\.\d\//', $path) === 1 ? '' : self::API_DEFAULT_VERSION,
            empty($query) ? $path : $path.'?'.http_build_query($query),
        ]));
    }

    abstract public function get(string $path, array $queryParams = []): mixed;

    abstract public function post(string $path, array $data = [], array $queryParams = []): mixed;

    abstract public function put(string $path, array $data = [], array $queryParams = []): mixed;

    abstract public function delete(string $path, array $data = [], array $queryParams = []): mixed;

    abstract public function patch(string $path, array $data = [], array $queryParams = []): mixed;
}
