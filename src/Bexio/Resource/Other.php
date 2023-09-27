<?php

namespace Bexio\Resource;

use Bexio\Bexio;

class Other extends Bexio
{
    /**
     * Fetch a list of company profiles
     */
    public function getCompanyProfiles(): mixed
    {
        return $this->client->get('company_profile');
    }

    /**
     * Get company profile
     */
    public function getCompanyProfile(int $id): mixed
    {
        return $this->client->get("company_profile/$id");
    }

    /**
     * Get available countries
     */
    public function getCountries(array $params = []): mixed
    {
        return $this->client->get('country', $params);
    }

    /**
     * Get available languages
     */
    public function getLanguages(array $params = []): mixed
    {
        return $this->client->get('language', $params);
    }

    /**
     * Get available payment types
     */
    public function getPaymentTypes(array $params = []): mixed
    {
        return $this->client->get('payment_type', $params);
    }

    /**
     * Get available units
     */
    public function getUnits(array $params = []): mixed
    {
        return $this->client->get('unit', $params);
    }
}
