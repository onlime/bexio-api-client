<?php
namespace Bexio\Resource;

use Bexio\Bexio;

/**
 * Class Item
 * @package Bexio\Resource
 */
class Item extends Bexio
{
   /**
     * Gets all items
     *
     * @param array $params
     * @return array
     */
    public function getItems(array $params = [])
    {
        return $this->client->get('article', $params);
    }

    /**
     * Search for items
     *
     * @param array $params
     * @param array $queryParams
     * @return mixed
     */
    public function searchItems(array $params = [], array $queryParams = [])
    {
        return $this->client->post('article/search', $params, $queryParams);
    }

    /**
     * Get specific item
     *
     * @param $id
     * @return mixed
     */
    public function getItem(int $id)
    {
        return $this->client->get("article/$id");
    }

    /**
     * Add new item
     * 
     * @param array $params
     * @return mixed
     */
    public function createItem(array $params = [])
    {
        return $this->client->post('article', $params);
    }

    /**
     * Edit item
     *
     * @param $id
     * @param array $params
     * @return mixed
     */
    public function editItem(int $id, array $params = [])
    {
        return $this->client->post("article/$id", $params);
    }

    /**
     * Delete specific item
     *
     * @param $id
     * @return mixed
     */
    public function deleteItem(int $id)
    {
        return $this->client->delete("article/$id");
    }
}
