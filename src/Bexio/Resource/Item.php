<?php

namespace Bexio\Resource;

use Bexio\Bexio;

/**
 * Class Item
 */
class Item extends Bexio
{
    /**
     * Gets all items
     *
     * @return array
     */
    public function getItems(array $params = [])
    {
        return $this->client->get('article', $params);
    }

    /**
     * Search for items
     *
     * @return mixed
     */
    public function searchItems(array $params = [], array $queryParams = [])
    {
        return $this->client->post('article/search', $params, $queryParams);
    }

    /**
     * Get specific item
     *
     * @return mixed
     */
    public function getItem(int $id)
    {
        return $this->client->get("article/$id");
    }

    /**
     * Add new item
     *
     * @return mixed
     */
    public function createItem(array $params = [])
    {
        return $this->client->post('article', $params);
    }

    /**
     * Edit item
     *
     * @return mixed
     */
    public function editItem(int $id, array $params = [])
    {
        return $this->client->post("article/$id", $params);
    }

    /**
     * Delete specific item
     *
     * @return mixed
     */
    public function deleteItem(int $id)
    {
        return $this->client->delete("article/$id");
    }
}
