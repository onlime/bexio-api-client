<?php
namespace Bexio\Resource;

use Bexio\Bexio;

/**
 * Class Discount
 * @package Bexio\Resource
 */
class Discount extends Bexio
{
    /**
     * Gets all discounts
     * 
     * @param string $resource
     * @param int $parentId
     * @return array
     */
    public function getDiscounts(string $resource, int $parentId, array $params = [])
    {
        return $this->client->get("$resource/$parentId/kb_position_discount", $params);
    }

    /**
     * Search for discounts
     *
     * @param string $resource 
     * @param int $parentId
     * @param array $params
     * @return mixed
     */
    public function searchDiscounts(string $resource, int $parentId, array $params = [])
    {
        return $this->client->get("$resource/$parentId/kb_position_discount", $params);
    }

    /**
     * Get specific discount
     *
     * @param string $resource
     * @param int $parentId
     * @param int $id
     * @return mixed
     */
    public function getDiscount(string $resource, int $parentId, int $id)
    {
        return $this->client->get("$resource/$parentId/kb_position_discount/$id");
    }

    /**
     * Add new discount
     * 
     * @param string $resource
     * @param int $parentId
     * @param array $params
     * @return mixed
     */
    public function createDiscount(string $resource, int $parentId, array $params = [])
    {
        return $this->client->post("$resource/$parentId/kb_position_discount", $params);
    }
}
