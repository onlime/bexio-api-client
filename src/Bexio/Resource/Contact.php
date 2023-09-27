<?php

namespace Bexio\Resource;

use Bexio\Bexio;

/**
 * Class Contact
 */
class Contact extends Bexio
{
    /**
     * Gets all the contacts
     *
     * @return array
     */
    public function getContacts(array $params = [])
    {
        return $this->client->get('contact', $params);
    }

    /**
     * Search for contacts
     *
     * @return mixed
     */
    public function searchContacts(array $params = [], array $queryParams = [])
    {
        return $this->client->post('contact/search', $params, $queryParams);
    }

    /**
     * Get specific contact
     *
     * @return mixed
     */
    public function getContact(int $id)
    {
        return $this->client->get("contact/$id");
    }

    /**
     * Add new contact
     *
     * @return mixed
     */
    public function createContact(array $params = [])
    {
        return $this->client->post('contact', $params);
    }

    /**
     * Create multiple contacts in a single request
     *
     * @return mixed
     */
    public function bulkCreateContacts(array $params = [])
    {
        return $this->client->post('contact/_bulk_create', $params);
    }

    /**
     * Edit contact
     *
     * @return mixed
     */
    public function editContact(int $id, array $params = [])
    {
        return $this->client->post("contact/$id", $params);
    }

    /**
     * Get relations from contacts
     *
     * @return mixed
     */
    public function getContactsRelations(array $params = [])
    {
        return $this->client->get('contact_relation', $params);
    }

    /**
     * Delete specific contact
     *
     * @return mixed
     */
    public function deleteContact(int $id)
    {
        return $this->client->delete("contact/$id");
    }

    /**
     * Get available salutations
     *
     * @return mixed
     */
    public function getSalutations(array $params = [])
    {
        return $this->client->get('salutation', $params);
    }

    /**
     * Get available titles
     *
     * @return mixed
     */
    public function getTitles(array $params = [])
    {
        return $this->client->get('title', $params);
    }
}
