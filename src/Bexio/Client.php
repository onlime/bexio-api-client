<?php

namespace Bexio;

use Bexio\Auth\OAuth2;
use Curl\Curl;

class Client
{
    const API_URL = 'https://office.bexio.com/api2.php';
    const OAUTH2_AUTH_URL = 'https://office.bexio.com/oauth/authorize';
    const OAUTH2_TOKEN_URI = 'https://office.bexio.com/oauth/access_token';
    const OAUTH2_REFRESH_TOKEN_URI = 'https://office.bexio.com/oauth/refresh_token';

    /**
     * @var array $config
     */
    private $config;

    /**
     * @var
     */
    private $accessToken;

    /**
     * @var
     */
    private $auth;

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

    public function getOrg()
    {
        return $this->accessToken['org'];
    }

    /**
     * @param $accessToken
     * @throws \UnexpectedValueException
     */
    public function setAccessToken($accessToken)
    {
        if (is_string($accessToken)) {
            if ($json = json_decode($accessToken, true)) {
                $accessToken = $json;
            } else {
                $accessToken = [
                    'access_token' => $accessToken,
                ];
            }
        }

        if ($accessToken == null) {
            throw new \UnexpectedValueException('Invalid json token');
        }

        if (!isset($accessToken['access_token'])) {
            throw new \UnexpectedValueException('Invalid token format');
        }
        $this->accessToken = $accessToken;
    }

    public function getAccessToken()
    {
        return $this->accessToken;
    }

    public function isAccessTokenExpired()
    {
        if (!$this->accessToken) {
            return true;
        }

        $created = 0;
        $expiresIn = 0;

        if (isset($this->accessToken['created'])) {
            $created = $this->accessToken['created'];
        }

        if (isset($this->accessToken['expires_in'])) {
            $expiresIn = $this->accessToken['expires_in'];
        }

        return ($created + ($expiresIn - 30)) < time();
    }

    public function getRefreshToken()
    {
        if (isset($this->accessToken['refresh_token'])) {
            return $this->accessToken['refresh_token'];
        }
    }

    public function fetchAuthCode()
    {
        $auth = $this->getOAuth2Service();
        $auth->setRedirectUrl($this->getRedirectUrl());
    }

    public function fetchAccessTokenWithAuthCode($code)
    {
        if (strlen($code) === 0) {
            throw new \UnexpectedValueException("Invalid code");
        }

        $auth = $this->getOAuth2Service();
        $auth->setCode($code);
        $auth->setRedirectUrl($this->getRedirectUrl());

        $credentials = $auth->fetchAuthToken();

        if ($credentials && isset($credentials['access_token'])) {
            $credentials['created'] = time();
            $this->setAccessToken($credentials);
        }

        return $credentials;
    }

    public function refreshToken(string $refreshToken = null)
    {
        if ($refreshToken === null) {
            if (!isset($this->accessToken['refresh_token'])) {
                throw new \InvalidArgumentException('Refresh token must be passed or set as part of the accessToken');
            }

            $refreshToken = $this->accessToken['refresh_token'];
        }

        $auth = $this->getOAuth2Service();
        $auth->setRefreshToken($refreshToken);

        $credentials = $auth->fetchAuthToken();

        if ($credentials && isset($credentials['access_token'])) {
            $credentials['created'] = time();
            if (!isset($credentials['refresh_token'])) {
                $credentials['refresh_token'] = $refreshToken;
            }
            $this->setAccessToken($credentials);

            return $credentials;
        }

        throw new \Exception('Illegal access token received when token was refreshed');
    }

    /**
     * @return OAuth2
     */
    public function getOAuth2Service()
    {
        if (!isset($this->auth)) {
            $this->auth = new OAuth2(
                [
                    'clientId'                  => $this->getClientId(),
                    'clientSecret'              => $this->getClientSecret(),
                    'authorizationUri'          => self::OAUTH2_AUTH_URL,
                    'tokenCredentialUri'        => self::OAUTH2_TOKEN_URI,
                    'refreshTokenCredentialUri' => self::OAUTH2_REFRESH_TOKEN_URI,
                    'redirectUrl'               => $this->getRedirectUrl(),
                    'issuer'                    => $this->config['clientId'],
                ]
            );
        }

        return $this->auth;
    }

    protected function getRequest()
    {
        $accessToken = $this->getAccessToken();

        $curl = new Curl();
        $curl->setHeader('Accept', 'application/json');
        $curl->setHeader('Authorization', 'Bearer '.$accessToken['access_token']);

        return $curl;
    }

    public function get(string $path, array $parameters = [])
    {
        $request = $this->getRequest();
        $request->get(self::API_URL.'/'.$this->getOrg().'/'.$path, $parameters);

        return json_decode($request->response);
    }

    public function post(string $path, array $parameters = [])
    {
        $request = $this->getRequest();
        $request->post(self::API_URL.'/'.$this->getOrg().'/'.$path, json_encode($parameters));

        return json_decode($request->response);
    }

    public function postWithoutPayload(string $path)
    {
        $request = $this->getRequest();
        $request->post(self::API_URL.'/'.$this->getOrg().'/'.$path);

        return json_decode($request->response);
    }

    public function put(string $path, array $parameters = [])
    {
        $request = $this->getRequest();
        $request->put(self::API_URL.'/'.$this->getOrg().'/'.$path, $parameters);

        return json_decode($request->response);
    }

    public function delete(string $path, array $parameters = [])
    {
        $request = $this->getRequest();
        $request->delete(self::API_URL.'/'.$this->getOrg().'/'.$path, $parameters);

        return json_decode($request->response);
    }
}