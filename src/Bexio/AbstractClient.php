<?php
namespace Bexio;

abstract class AbstractClient
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';
    const METHOD_PATCH = 'PATCH';

    abstract protected function request(string $path = '', string $method = self::METHOD_GET, array $data = [], array $queryParams = []);

    public function get(string $path, array $data = [], array $queryParams = [])
    {
        return $this->request($path, self::METHOD_GET, $data, $queryParams);
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
}
