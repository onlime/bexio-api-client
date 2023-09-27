<?php

namespace Bexio\Resource;

class Order extends AbstractDocumentPositions
{
    protected $documentType = 'kb_order';

    /**
     * Gets all orders
     */
    public function getOrders(array $params = []): mixed
    {
        return $this->client->get('kb_order', $params);
    }

    /**
     * Search for orders
     */
    public function searchOrders(array $params = [], array $queryParams = []): mixed
    {
        return $this->client->post('kb_order/search', $params, $queryParams);
    }

    /**
     * Get specific order
     */
    public function getOrder(int $id): mixed
    {
        return $this->client->get("kb_order/$id");
    }

    /**
     * Add new order
     */
    public function createOrder(array $params = []): mixed
    {
        return $this->client->post('kb_order', $params);
    }

    /**
     * Edit order
     */
    public function editOrder(int $id, array $params = []): mixed
    {
        return $this->client->post("kb_order/$id", $params);
    }

    /**
     * Delete order
     */
    public function deleteOrder(int $id): mixed
    {
        return $this->client->delete("kb_order/$id", []);
    }

    /**
     * Get repetition
     */
    public function getRepetition(int $id): mixed
    {
        return $this->client->get("kb_order/$id/repetition");
    }

    /**
     * Create repetition
     */
    public function createRepetition(int $id, array $params = []): mixed
    {
        return $this->client->post("kb_order/$id/repetition", $params);
    }

    /**
     * Delete repetition
     */
    public function deleteRepetition(int $id): mixed
    {
        return $this->client->delete("kb_order/$id/repetition");
    }

    public function createInvoice(int $id, array $params = []): mixed
    {
        return $this->client->post("kb_order/$id/invoice", $params);
    }

    public function createInvoiceWithAllOpenPositions(int $id): mixed
    {
        return $this->client->post("kb_order/$id/invoice");
    }

    /**
     * Get specific order PDF
     */
    public function getPdf(int $id): mixed
    {
        return $this->client->get("kb_order/$id/pdf");
    }

    /**
     * Get comments
     */
    public function getComments(int $id): mixed
    {
        return $this->client->get("kb_order/$id/comment");
    }

    /**
     * Get specific comment
     */
    public function getComment(int $id, int $commentId): mixed
    {
        return $this->client->get("kb_order/$id/comment/$commentId");
    }

    /**
     * Create comment
     */
    public function createComment(int $id, array $params = []): mixed
    {
        return $this->client->post("kb_order/$id/comment", $params);
    }
}
