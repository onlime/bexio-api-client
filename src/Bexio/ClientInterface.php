<?php
namespace Bexio;

interface ClientInterface
{
    public function get(string $path, array $data = []);
    public function post(string $path, array $data = []);
    public function put(string $path, array $data = []);
    public function delete(string $path, array $data = []);
}
