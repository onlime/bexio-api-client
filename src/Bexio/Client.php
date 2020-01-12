<?php
namespace Bexio;

use Jumbojett\OpenIDConnectClient;
use Curl\Curl;

class Client
{
    const PROVIDER_URL = 'https://idp.bexio.com';
    const API_URL = 'https://api.bexio.com/2.0';

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
     * @param string $redirectUrl
     */
    public function __construct(string $clientId, string $clientSecret, string $redirectUrl = null)
    {
        $this->config = [
            'clientId'     => $clientId,
            'clientSecret' => $clientSecret,
            'redirectUrl'  => $redirectUrl
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


    protected function getRequest()
    {
        $curl = new Curl();
        $curl->setHeader('Accept', 'application/json');
        $curl->setHeader('Authorization', 'Bearer ' . $this->getAccessToken());

        return $curl;
    }

    public function get(string $path, array $parameters = [])
    {
        $request = $this->getRequest();
        $request->get(self::API_URL.'/'.$path, $parameters);

        return json_decode($request->response);
    }

    public function post(string $path, array $parameters = [])
    {
        $request = $this->getRequest();
        $request->post(self::API_URL.'/'.$path, json_encode($parameters));

        return json_decode($request->response);
    }

    public function postWithoutPayload(string $path)
    {
        $request = $this->getRequest();
        $request->post(self::API_URL.'/'.$path);

        return json_decode($request->response);
    }

    public function put(string $path, array $parameters = [])
    {
        $request = $this->getRequest();
        $request->put(self::API_URL.'/'.$path, $parameters);

        return json_decode($request->response);
    }

    public function delete(string $path, array $parameters = [])
    {
        $request = $this->getRequest();
        $request->delete(self::API_URL.'/'.$path, $parameters);

        return json_decode($request->response);
    }
}