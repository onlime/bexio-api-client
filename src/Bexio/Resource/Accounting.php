<?php

namespace Bexio\Resource;

use Bexio\Bexio;

class Accounting extends Bexio
{
    /**
     * Fetch a list of accounts
     */
    public function getAccounts(array $params = []): mixed
    {
        return $this->client->get('3.0/accounts', $params);
    }

    /**
     * Fetch a list of taxes
     */
    public function getTaxes(array $params = []): mixed
    {
        return $this->client->get('3.0/taxes', $params);
    }

    /**
     * Fetch a list of currencies
     */
    public function getCurrencies(array $params = []): mixed
    {
        return $this->client->get('3.0/currencies', $params);
    }

    /**
     * Create new currency
     */
    public function createCurrency(array $params = []): mixed
    {
        return $this->client->post('3.0/currencies', $params);
    }

    /**
     * Fetch a currency
     */
    public function getCurrency(int $id): mixed
    {
        return $this->client->get("3.0/currencies/$id");
    }

    /**
     * Delete a currency
     */
    public function deleteCurrency(int $id): mixed
    {
        return $this->client->delete("3.0/currencies/$id");
    }

    /**
     * Update a currency
     */
    public function updateCurrency(int $id, array $params = []): mixed
    {
        return $this->client->patch("3.0/currencies/$id", $params);
    }
}
