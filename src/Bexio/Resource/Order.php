<?php

namespace Bexio\Resource;

/**
 * Class Order
 */
class Order extends AbstractDocumentPositions
{
    protected $documentType = 'kb_order';

    /**
     * Gets all orders
     *
     * @return array
     */
    public function getOrders(array $params = [])
    {
        return $this->client->get('kb_order', $params);
    }

    /**
     * Search for orders
     *
     * @return mixed
     */
    public function searchOrders(array $params = [], array $queryParams = [])
    {
        return $this->client->post('kb_order/search', $params, $queryParams);
    }

    /**
     * Get specific order
     *
     * @return mixed
     */
    public function getOrder(int $id)
    {
        return $this->client->get("kb_order/$id");
    }

    /**
     * Add new order
     *
     * @return mixed
     */
    public function createOrder(array $params = [])
    {
        return $this->client->post('kb_order', $params);
    }

    /**
     * Edit order
     *
     * @return mixed
     */
    public function editOrder(int $id, array $params = [])
    {
        return $this->client->post("kb_order/$id", $params);
    }

    /**
     * Delete order
     *
     * @return mixed
     */
    public function deleteOrder(int $id)
    {
        return $this->client->delete("kb_order/$id", []);
    }

    /**
     * Get repetition
     *
     * @return mixed
     */
    public function getRepetition(int $id)
    {
        return $this->client->get("kb_order/$id/repetition");
    }

    /**
     * Create repetition
     *
     * @return mixed
     */
    public function createRepetition(int $id, array $params = [])
    {
        return $this->client->post("kb_order/$id/repetition", $params);
    }

    /**
     * Delete repetition
     *
     * @return mixed
     */
    public function deleteRepetition(int $id)
    {
        return $this->client->delete("kb_order/$id/repetition");
    }

    /**
     * @return mixed
     */
    public function createInvoice(int $id, array $params = [])
    {
        return $this->client->post("kb_order/$id/invoice", $params);
    }

    /**
     * @return mixed
     */
    public function createInvoiceWithAllOpenPositions(int $id)
    {
        return $this->client->post("kb_order/$id/invoice");
    }

    /**
     * Get specific order PDF
     *
     * @return mixed
     */
    public function getPdf(int $id)
    {
        return $this->client->get("kb_order/$id/pdf");
    }

    /**
     * Get comments
     *
     * @return mixed
     */
    public function getComments(int $id)
    {
        return $this->client->get("kb_order/$id/comment");
    }

    /**
     * Get specific comment
     *
     * @return mixed
     */
    public function getComment(int $id, int $commentId)
    {
        return $this->client->get("kb_order/$id/comment/$commentId");
    }

    /**
     * Create comment
     *
     * @return mixed
     */
    public function createComment(int $id, array $params = [])
    {
        return $this->client->post("kb_order/$id/comment", $params);
    }
}
