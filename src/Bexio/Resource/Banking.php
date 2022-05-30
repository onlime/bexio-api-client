<?php
namespace Bexio\Resource;

use Bexio\Bexio;

/**
 * Class Banking
 * @package Bexio\Resource
 */
class Banking extends Bexio
{
    /**
     * Fetch a list of bank accounts
     *
     * @link https://docs.bexio.com/#tag/Bank-Accounts/operation/ListBankAccounts
     */
    public function getBankAccounts(array $params = []): array
    {
        return is_array($result = $this->client->get('3.0/banking/accounts', $params)) ? $result : [];
    }

    /**
     * Fetch a single bank account
     *
     * @link https://docs.bexio.com/#tag/Bank-Accounts/operation/ShowBankAccount
     */
    public function getBankAccount(int $id): ?\stdClass
    {
        try {
            return (($result = $this->client->get('3.0/banking/accounts/' . $id)) instanceof \stdClass) ? $result : null;
        } catch (\Exception $e) {
            // The bank account doesn't exist
            return null;
        }
    }
}
