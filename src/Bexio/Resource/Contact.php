<?php

namespace Bexio\Resource;

use Bexio\Bexio;

class Contact extends Bexio
{
    /**
     * Gets all the contacts
     */
    public function getContacts(array $params = []): mixed
    {
        return $this->client->get('contact', $params);
    }

    /**
     * Search for contacts
     */
    public function searchContacts(array $params = [], array $queryParams = []): mixed
    {
        return $this->client->post('contact/search', $params, $queryParams);
    }

    /**
     * Get specific contact
     */
    public function getContact(int $id): mixed
    {
        return $this->client->get("contact/$id");
    }

    /**
     * Add new contact
     */
    public function createContact(array $params = []): mixed
    {
        return $this->client->post('contact', $params);
    }

    /**
     * Create multiple contacts in a single request
     */
    public function bulkCreateContacts(array $params = []): mixed
    {
        return $this->client->post('contact/_bulk_create', $params);
    }

    /**
     * Edit contact
     */
    public function editContact(int $id, array $params = []): mixed
    {
        return $this->client->post("contact/$id", $params);
    }

    /**
     * Get relations from contacts
     */
    public function getContactsRelations(array $params = []): mixed
    {
        return $this->client->get('contact_relation', $params);
    }

    /**
     * Delete specific contact
     */
    public function deleteContact(int $id): mixed
    {
        return $this->client->delete("contact/$id");
    }

    /**
     * Get available salutations
     */
    public function getSalutations(array $params = []): mixed
    {
        return $this->client->get('salutation', $params);
    }

    /**
     * Get available titles
     */
    public function getTitles(array $params = []): mixed
    {
        return $this->client->get('title', $params);
    }
}
