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

    private array $config;
    private string $accessToken;
    private string $refreshToken;

    /**
     * Client constructor.
     *
     * @param string $clientId
     * @param string $clientSecret
     * @param string|null $redirectUrl
     */
    public function __construct(string $clientId, string $clientSecret, string $redirectUrl = null)
    {
        $this->config = [
            'clientId'     => $clientId,
            'clientSecret' => $clientSecret,
            'redirectUrl'  => $redirectUrl,
        ];
    }

    public function setClientId($clientId)
    {
        $this->config['clientId'] = $clientId;
    }

    public function getClientId()
    {
        return $this->config['clientId'];
    }

    public function setClientSecret($clientId)
    {
        $this->config['clientSecret'] = $clientId;
    }

    public function getClientSecret()
    {
        return $this->config['clientSecret'];
    }

    public function setRedirectUrl($redirectUrl)
    {
        $this->config['redirectUrl'] = $redirectUrl;
    }

    public function getRedirectUrl()
    {
        return $this->config['redirectUrl'];
    }

    public function setAccessToken(string $accessToken)
    {
        $this->accessToken = $accessToken;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function setRefreshToken(string $refreshToken)
    {
        $this->refreshToken = $refreshToken;
    }

    public function getRefreshToken()
    {
        return $this->refreshToken;
    }

    public function persistTokens(string $tokensFile): bool
    {
        return false !== file_put_contents($tokensFile, json_encode([
            'accessToken' => $this->getAccessToken(),
            'refreshToken' => $this->getRefreshToken()
        ]));
    }

    public function loadTokens(string $tokensFile)
    {
        if (!file_exists($tokensFile)) {
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
            $this->getClientId(),
            $this->getClientSecret()
        );
        $oidc->setAccessToken($this->accessToken);
        return $oidc;
    }

    public function authenticate($scopes)
    {
        if (!is_array($scopes)) {
            $scopes = explode(' ', $scopes);
        }
        $oidc = $this->getOpenIDConnectClient();
        $oidc->setRedirectURL($this->getRedirectUrl());
        $oidc->addScope($scopes);
        $oidc->authenticate();

        $this->setAccessToken($oidc->getAccessToken());
        $this->setRefreshToken($oidc->getRefreshToken());
    }

    public function isAccessTokenExpired($gracePeriod = 30): bool
    {
        if (!$this->accessToken) {
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

    public function getFullApiUrl(string $path = '')
    {
        // prefix path with default API version if there was no version provided
        return implode('/', array_filter([
            self::API_URL,
            1 === preg_match('/\d\.\d\//', $path) ? '' : self::API_DEFAULT_VERSION,
            $path
        ]));
    }

    public function get(string $path, array $queryParams = [])
    {
        return $this->request($path, self::METHOD_GET, queryParams: $queryParams);
    }

    public function post(string $path, array $data = [], array $queryParams = [])
    {
        return $this->request($path, self::METHOD_POST, $data, $queryParams);
    }

    public function put(string $path, array $data = [], array $queryParams = [])
    {
        return $this->request($path, self::METHOD_PUT, $data, $queryParams);
    }

    public function delete(string $path, array $data = [], array $queryParams = [])
    {
        return $this->request($path, self::METHOD_DELETE, $data, $queryParams);
    }

    public function patch(string $path, array $data = [], array $queryParams = [])
    {
        return $this->request($path, self::METHOD_PATCH, $data, $queryParams);
    }

    abstract protected function request(
        string $path = '',
        string $method = self::METHOD_GET,
        array $data = [],
        array $queryParams = []
    );
}
