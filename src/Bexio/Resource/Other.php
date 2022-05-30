<?php
namespace Bexio\Resource;

use Bexio\Bexio;

/**
 * Class Other
 * @package Bexio\Resource
 */
class Other extends Bexio
{
    /**
     * Fetch a list of company profiles
     *
     * @return array
     */
    public function getCompanyProfiles()
    {
        return $this->client->get('company_profile');
    }

    /**
     * Get company profile
     *
     * @param int $id
     * @return mixed
     */
    public function getCompanyProfile(int $id)
    {
        return $this->client->get("company_profile/$id");
    }

    /**
     * Get available countries
     *
     * @return mixed
     */
    public function getCountries(array $params = [])
    {
        return $this->client->get('country', $params);
    }

    /**
     * Get available languages
     *
     * @return mixed
     */
    public function getLanguages(array $params = [])
    {
        return $this->client->get('language', $params);
    }

    /**
     * Get available payment types
     *
     * @return mixed
     */
    public function getPaymentTypes(array $params = [])
    {
        return $this->client->get('payment_type', $params);
    }

    /**
     * Get available units
     *
     * @return mixed
     */
    public function getUnits(array $params = [])
    {
        return $this->client->get('unit', $params);
    }

    /**
     * Fetch a list of users
     *
     * @link https://docs.bexio.com/#tag/User-Management/operation/v3ListUsers
     */
    public function getUsers(array $params = []): array
    {
        return is_array($result = $this->client->get('3.0/users', $params)) ? $result : [];
    }
}
