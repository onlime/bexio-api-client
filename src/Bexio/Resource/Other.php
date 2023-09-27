<?php

namespace Bexio\Resource;

use Bexio\Bexio;

/**
 * Class Other
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
}
