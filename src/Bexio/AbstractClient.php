<?php
namespace Bexio;

abstract class AbstractClient
{
    const METHOD_GET = 'GET';
    const METHOD_POST = 'POST';
    const METHOD_PUT = 'PUT';
    const METHOD_DELETE = 'DELETE';
    const METHOD_PATCH = 'PATCH';

    abstract protected function request(string $path = '', string $method = self::METHOD_GET, array $data = []);

    public function get(string $path, array $data = [])
    {
        return $this->request($path, self::METHOD_GET, $data);
    }

    public function post(string $path, array $data = [])
    {
        return $this->request($path, self::METHOD_POST, $data);
    }

    public function put(string $path, array $data = [])
    {
        return $this->request($path, self::METHOD_PUT, $data);
    }

    public function delete(string $path, array $data = [])
    {
        return $this->request($path, self::METHOD_DELETE, $data);
    }
}
