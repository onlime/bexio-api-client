<?php
namespace Bexio;

use Bexio\Exception\BexioClientException;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Client as GuzzleClient;

class Client extends AbstractClient
{
    protected function request(string $path = '', string $method = self::METHOD_GET, array $data = [], array $queryParams = [])
    {
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
            $response = (new GuzzleClient())->request($method, $this->getFullApiUrl($path), $options);
        } catch (ClientException $e) {
            // transform Guzzle ClientException into some more readable form, so that body content does not get truncated
            $body = json_decode($e->getResponse()->getBody()->getContents());
            throw new BexioClientException($body->message . ' ' . json_encode($body->errors), $body->error_code);
        }

        return json_decode($response->getBody());
    }
}
