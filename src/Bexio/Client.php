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
        return $oidc->getRefreshToken();
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

    public function refreshToken(string $refreshToken)
    {
        $oidc = $this->getOpenIDConnectClient();
        $oidc->refreshToken($refreshToken);
        $this->setAccessToken($oidc->getAccessToken());
        // return new refreshToken
        return $oidc->getRefreshToken();
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