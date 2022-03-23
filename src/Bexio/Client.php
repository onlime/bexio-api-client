<?php
namespace Bexio;

use Bexio\Exception\BexioClientException;
use Jumbojett\OpenIDConnectClient;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client as GuzzleClient;

class Client extends AbstractClient
{
    const PROVIDER_URL = 'https://idp.bexio.com';
    const API_URL = 'https://api.bexio.com';
    const API_DEFAULT_VERSION = '2.0';

    /**
     * @var array $config
     */
    private $config;

    /**
     * @var string
     */
    private $accessToken;

    /**
     * @var string
     */
    private $refreshToken;

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

    public function persistTokens(string $tokensFile)
    {
        $result = file_put_contents($tokensFile, json_encode([
            'accessToken' => $this->getAccessToken(),
            'refreshToken' => $this->getRefreshToken()
        ]));
        return ($result !== false);
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

    /**
     * @return OpenIDConnectClient
     */
    public function getOpenIDConnectClient()
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
        if (!\is_array($scopes)) {
            $scopes = \explode(' ', $scopes);
        }
        $oidc = $this->getOpenIDConnectClient();
        $oidc->setRedirectURL($this->getRedirectUrl());
        $oidc->addScope($scopes);
        $oidc->authenticate();

        $this->setAccessToken($oidc->getAccessToken());
        $this->setRefreshToken($oidc->getRefreshToken());
    }

    public function isAccessTokenExpired($gracePeriod = 30)
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

    protected function request(string $path = '', string $method = self::METHOD_GET, array $data = [], array $queryParams = [])
    {
        // prefix path with default API version if there was no version provided
        $apiUrl = implode('/', array_filter([
            self::API_URL,
            (1 === preg_match('/\d\.\d\//', $path)) ? '' : self::API_DEFAULT_VERSION,
            $path
        ]));

        $options = [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->getAccessToken(),
                'Accept' => 'application/json',
            ],
            'allow_redirects' => false,
        ];

        if (!empty($queryParams)) {
            $options['query'] = $queryParams;
        }

        if (!empty($data) && self::METHOD_GET !== $method) {
            $options['json'] = $data;
        }

        try {
            $response = (new GuzzleClient())->request($method, $apiUrl, $options);
        } catch (ClientException $e) {
            // transform Guzzle ClientException into some more readable form, so that body content does not get truncated
            $body = json_decode($e->getResponse()->getBody()->getContents());
            throw new BexioClientException($body->message . ' ' . json_encode($body->errors), $body->error_code);
        }

        return json_decode($response->getBody());
    }
}
