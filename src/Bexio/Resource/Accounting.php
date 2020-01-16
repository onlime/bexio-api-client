<?php
namespace Bexio\Resource;

use Bexio\Bexio;

/**
 * Class Other
 * @package Bexio\Resource
 */
class Accounting extends Bexio
{
    /**
     * Fetch a list of accounts
     *
     * @return mixed
     */
    public function getAccounts(array $params = [])
    {
        return $this->client->get('3.0/accounts', $params);
    }

    /**
     * Fetch a list of taxes
     *
     * @return mixed
     */
    public function getTaxes(array $params = [])
    {
        return $this->client->get('3.0/taxes', $params);
    }
}
