<?php

namespace Bexio;

use Bexio\Exception\BexioClientException;
use GuzzleHttp\Client as GuzzleClient;
use GuzzleHttp\Exception\ClientException;

class Client extends AbstractClient
{
    public function get(string $path, array $queryParams = []): mixed
    {
        return $this->request($path, queryParams: $queryParams);
    }

    public function post(string $path, array $data = [], array $queryParams = []): mixed
    {
        return $this->request($path, self::METHOD_POST, $data, $queryParams);
    }

    public function put(string $path, array $data = [], array $queryParams = []): mixed
    {
        return $this->request($path, self::METHOD_PUT, $data, $queryParams);
    }

    public function delete(string $path, array $data = [], array $queryParams = []): mixed
    {
        return $this->request($path, self::METHOD_DELETE, $data, $queryParams);
    }

    public function patch(string $path, array $data = [], array $queryParams = []): mixed
    {
        return $this->request($path, self::METHOD_PATCH, $data, $queryParams);
    }

    protected function request(
        string $path = '',
        string $method = self::METHOD_GET,
        array $data = [],
        array $queryParams = []
    ): mixed {
        $options = [
            'headers' => [
                'Authorization' => 'Bearer '.$this->getAccessToken(),
                'Accept' => 'application/json',
            ],
            'allow_redirects' => false,
        ];

        if (! empty($queryParams)) {
            $options['query'] = $queryParams;
        }

        if (! empty($data) && $method !== self::METHOD_GET) {
            $options['json'] = $data;
        }

        try {
            $response = (new GuzzleClient)->request($method, $this->getFullApiUrl($path), $options);
        } catch (ClientException $e) {
            // transform Guzzle ClientException into some more readable form, so that body content does not get truncated
            $body = json_decode($e->getResponse()->getBody()->getContents());
            throw new BexioClientException($body->message.' '.json_encode($body->errors), $body->error_code);
        }

        return json_decode($response->getBody());
    }
}
