<?php

namespace Bexio\Resource;

use Bexio\Bexio;

class Item extends Bexio
{
    /**
     * Gets all items
     */
    public function getItems(array $params = []): mixed
    {
        return $this->client->get('article', $params);
    }

    /**
     * Search for items
     */
    public function searchItems(array $params = [], array $queryParams = []): mixed
    {
        return $this->client->post('article/search', $params, $queryParams);
    }

    /**
     * Get specific item
     */
    public function getItem(int $id): mixed
    {
        return $this->client->get("article/$id");
    }

    /**
     * Add new item
     */
    public function createItem(array $params = []): mixed
    {
        return $this->client->post('article', $params);
    }

    /**
     * Edit item
     */
    public function editItem(int $id, array $params = []): mixed
    {
        return $this->client->post("article/$id", $params);
    }

    /**
     * Delete specific item
     */
    public function deleteItem(int $id): mixed
    {
        return $this->client->delete("article/$id");
    }
}
