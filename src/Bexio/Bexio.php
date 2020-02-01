<?php
namespace Bexio;

class Bexio
{
    /**
     * @var AbstractClient
     */
    protected $client;

    public function __construct(AbstractClient $client)
    {
        $this->client = $client;
    }
}