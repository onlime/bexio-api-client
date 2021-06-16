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
     * @param array $params
     * @return mixed
     */
    public function getAccounts(array $params = [])
    {
        return $this->client->get('3.0/accounts', $params);
    }

    /**
     * Fetch a list of taxes
     *
     * @param array $params
     * @return mixed
     */
    public function getTaxes(array $params = [])
    {
        return $this->client->get('3.0/taxes', $params);
    }

    /**
     * Fetch a list of currencies
     *
     * @param array $params
     * @return mixed
     */
    public function getCurrencies(array $params = [])
    {
        return $this->client->get('3.0/currencies', $params);
    }

    /**
     * Create new currency
     *
     * @param array $params
     * @return mixed
     */
    public function createCurrency(array $params = [])
    {
        return $this->client->post('3.0/currencies', $params);
    }

    /**
     * Fetch a currency
     *
     * @param int $id
     * @return mixed
     */
    public function getCurrency(int $id)
    {
        return $this->client->get("3.0/currencies/$id");
    }

    /**
     * Delete a currency
     *
     * @param int $id
     * @return mixed
     */
    public function deleteCurrency(int $id)
    {
        return $this->client->delete("3.0/currencies/$id");
    }

    /**
     * Update a currency
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function updateCurrency(int $id, array $params = [])
    {
        return $this->client->patch("3.0/currencies/$id", $params);
    }
}
