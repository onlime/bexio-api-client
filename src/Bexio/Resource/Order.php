<?php
namespace Bexio\Resource;

use Bexio\Resource\AbstractDocumentPositions;

/**
 * Class Order
 * @package Bexio\Resource
 */
class Order extends AbstractDocumentPositions
{
    protected $documentType = 'kb_order';

    /**
     * Gets all orders
     *
     * @param array $params
     * @return array
     */
    public function getOrders(array $params = [])
    {
        return $this->client->get('kb_order', $params);
    }

    /**
     * Search for orders
     *
     * @param array $params
     * @return mixed
     */
    public function searchOrders(array $params = [])
    {
        return $this->client->post('kb_order/search', $params);
    }

    /**
     * Get specific order
     *
     * @param $id
     * @return mixed
     */
    public function getOrder(int $id)
    {
        return $this->client->get("kb_order/$id", []);
    }

    /**
     * Add new order
     * 
     * @param array $params
     * @return mixed
     */
    public function createOrder(array $params = [])
    {
        return $this->client->post('kb_order', $params);
    }

    /**
     * Edit order
     *
     * @param $id
     * @param array $params
     * @return mixed
     */
    public function editOrder(int $id, array $params = [])
    {
        return $this->client->post("kb_order/$id", $params);
    }

    /**
     * Delete order
     *
     * @param $id
     * @return mixed
     */
    public function deleteOrder(int $id)
    {
        return $this->client->delete("kb_order/$id", []);
    }

    /**
     * Get repetition
     *
     * @param $id
     * @return mixed
     */
    public function getRepetition(int $id)
    {
        return $this->client->get("kb_order/$id/repetition", []);
    }

    /**
     * Create repetition
     *
     * @param $id
     * @param array $params
     * @return mixed
     */
    public function createRepetition(int $id, array $params = [])
    {
        return $this->client->post("kb_order/$id/repetition", $params);
    }

    /**
     * Delete repetition
     *
     * @param $id
     * @return mixed
     */
    public function deleteRepetition(int $id)
    {
        return $this->client->delete("kb_order/$id/repetition");
    }

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function createInvoice(int $id, array $params = [])
    {
        return $this->client->post("kb_order/$id/invoice", $params);
    }

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function createInvoiceWithAllOpenPositions(int $id)
    {
        return $this->client->post("kb_order/$id/invoice");
    }

    /**
     * Get specific order PDF
     *
     * @param int $id
     * @return mixed
     */
    public function getPdf(int $id)
    {
        return $this->client->get("kb_order/$id/pdf");
    }

    /**
     * Get comments
     *
     * @param int $id
     * @return mixed
     */
    public function getComments(int $id)
    {
        return $this->client->get("kb_order/$id/comment");
    }

    /**
     * Get specific comment
     *
     * @param int $id
     * @param int $commentId
     * @return mixed
     */
    public function getComment(int $id, int $commentId)
    {
        return $this->client->get("kb_order/$id/comment/$commentId");
    }

    /**
     * Create comment
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function createComment(int $id, array $params = [])
    {
        return $this->client->post("kb_order/$id/comment", $params);
    }
}
