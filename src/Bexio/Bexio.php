<?php

namespace Bexio;

class Bexio
{
    public function __construct(
        protected AbstractClient $client
    ) {}
}
