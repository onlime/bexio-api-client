<?php

namespace Bexio\Resource;

use Bexio\Bexio;

/**
 * Class Invoice
 */
abstract class AbstractDocumentPositions extends Bexio
{
    protected $documentType = 'kb_foo'; // replace this in concrete class by kb_offer|kb_order|kb_invoice

    /**
     * @param int   $documentId
     * @param array $params
     * @return mixed
     */
    public function listDefaultPositions(int $documentId, array $params = [])
    {
        return $this->client->get($this->documentType . "/$documentId/kb_position_custom", $params);
    }

    /**
     * @param int $documentId
     * @param int $itemId
     * @return mixed
     */
    public function showDefaultPosition(int $documentId, int $itemId)
    {
        return $this->client->get($this->documentType . "/$documentId/kb_position_custom/$itemId");
    }

    /**
     * @param int $documentId
     * @param array $params
     * @return mixed
     */
    public function createDefaultPosition(int $documentId, array $params = [])
    {
        return $this->client->post($this->documentType . "/$documentId/kb_position_custom", $params);
    }

    /**
     * @param int $documentId
     * @param int $itemId
     * @param array $params
     * @return mixed
     */
    public function editDefaultPosition(int $documentId, int $itemId, array $params = [])
    {
        return $this->client->post($this->documentType . "/$documentId/kb_position_custom/$itemId", $params);
    }

    /**
     * @param int $documentId
     * @param int $itemId
     * @param array $params
     * @return mixed
     */
    public function overwriteDefaultPosition(int $documentId, int $itemId, array $params = [])
    {
        return $this->client->put($this->documentType . "/$documentId/kb_position_custom/$itemId", $params);
    }

    /**
     * @param int $documentId
     * @param int $itemId
     * @return mixed
     */
    public function deleteDefaultPosition(int $documentId, int $itemId)
    {
        return $this->client->delete($this->documentType . "/$documentId/kb_position_custom/$itemId");
    }

    /**
     * @param int   $documentId
     * @param array $params
     * @return mixed
     */
    public function listItemPositions(int $documentId, array $params = [])
    {
        return $this->client->get($this->documentType . "/$documentId/kb_position_article", $params);
    }

    /**
     * @param int $documentId
     * @param int $itemId
     * @return mixed
     */
    public function showItemPosition(int $documentId, int $itemId)
    {
        return $this->client->get($this->documentType . "/$documentId/kb_position_article/$itemId");
    }

    /**
     * @param int $documentId
     * @param array $params
     * @return mixed
     */
    public function createItemPosition(int $documentId, array $params = [])
    {
        return $this->client->post($this->documentType . "/$documentId/kb_position_article", $params);
    }

    /**
     * @param int $documentId
     * @param int $itemId
     * @param array $params
     * @return mixed
     */
    public function editItemPosition(int $documentId, int $itemId, array $params = [])
    {
        return $this->client->post($this->documentType . "/$documentId/kb_position_article/$itemId", $params);
    }

    /**
     * @param int $documentId
     * @param int $itemId
     * @param array $params
     * @return mixed
     */
    public function overwriteItemPosition(int $documentId, int $itemId, array $params = [])
    {
        return $this->client->put($this->documentType . "/$documentId/kb_position_article/$itemId", $params);
    }

    /**
     * @param int $documentId
     * @param int $itemId
     * @return mixed
     */
    public function deleteItemPosition(int $documentId, int $itemId)
    {
        return $this->client->delete($this->documentType . "/$documentId/kb_position_article/$itemId");
    }

    /**
     * @param int   $documentId
     * @param array $params
     * @return mixed
     */
    public function listDiscountPositions(int $documentId, array $params = [])
    {
        return $this->client->get($this->documentType . "/$documentId/kb_position_discount", $params);
    }

    /**
     * @param int $documentId
     * @param int $itemId
     * @return mixed
     */
    public function showDiscountPosition(int $documentId, int $itemId)
    {
        return $this->client->get($this->documentType . "/$documentId/kb_position_discount/$itemId");
    }

    /**
     * @param int $documentId
     * @param array $params
     * @return mixed
     */
    public function createDiscountPosition(int $documentId, array $params = [])
    {
        return $this->client->post($this->documentType . "/$documentId/kb_position_discount", $params);
    }

    /**
     * @param int $documentId
     * @param int $itemId
     * @param array $params
     * @return mixed
     */
    public function editDiscountPosition(int $documentId, int $itemId, array $params = [])
    {
        return $this->client->post($this->documentType . "/$documentId/kb_position_discount/$itemId", $params);
    }

    /**
     * @param int $documentId
     * @param int $itemId
     * @param array $params
     * @return mixed
     */
    public function overwriteDiscountPosition(int $documentId, int $itemId, array $params = [])
    {
        return $this->client->put($this->documentType . "/$documentId/kb_position_discount/$itemId", $params);
    }

    /**
     * @param int $documentId
     * @param int $itemId
     * @return mixed
     */
    public function deleteDiscountPosition(int $documentId, int $itemId)
    {
        return $this->client->delete($this->documentType . "/$documentId/kb_position_discount/$itemId");
    }
}
