<?php

namespace Bexio\Resource;

use Bexio\Bexio;

abstract class AbstractDocumentPositions extends Bexio
{
    protected $documentType = 'kb_foo'; // replace this in concrete class by kb_offer|kb_order|kb_invoice

    public function listDefaultPositions(int $documentId, array $params = []): mixed
    {
        return $this->client->get($this->documentType."/$documentId/kb_position_custom", $params);
    }

    public function showDefaultPosition(int $documentId, int $itemId): mixed
    {
        return $this->client->get($this->documentType."/$documentId/kb_position_custom/$itemId");
    }

    public function createDefaultPosition(int $documentId, array $params = []): mixed
    {
        return $this->client->post($this->documentType."/$documentId/kb_position_custom", $params);
    }

    public function editDefaultPosition(int $documentId, int $itemId, array $params = []): mixed
    {
        return $this->client->post($this->documentType."/$documentId/kb_position_custom/$itemId", $params);
    }

    public function overwriteDefaultPosition(int $documentId, int $itemId, array $params = []): mixed
    {
        return $this->client->put($this->documentType."/$documentId/kb_position_custom/$itemId", $params);
    }

    public function deleteDefaultPosition(int $documentId, int $itemId): mixed
    {
        return $this->client->delete($this->documentType."/$documentId/kb_position_custom/$itemId");
    }

    public function listItemPositions(int $documentId, array $params = []): mixed
    {
        return $this->client->get($this->documentType."/$documentId/kb_position_article", $params);
    }

    public function showItemPosition(int $documentId, int $itemId): mixed
    {
        return $this->client->get($this->documentType."/$documentId/kb_position_article/$itemId");
    }

    public function createItemPosition(int $documentId, array $params = []): mixed
    {
        return $this->client->post($this->documentType."/$documentId/kb_position_article", $params);
    }

    public function editItemPosition(int $documentId, int $itemId, array $params = []): mixed
    {
        return $this->client->post($this->documentType."/$documentId/kb_position_article/$itemId", $params);
    }

    public function overwriteItemPosition(int $documentId, int $itemId, array $params = []): mixed
    {
        return $this->client->put($this->documentType."/$documentId/kb_position_article/$itemId", $params);
    }

    public function deleteItemPosition(int $documentId, int $itemId): mixed
    {
        return $this->client->delete($this->documentType."/$documentId/kb_position_article/$itemId");
    }

    public function listDiscountPositions(int $documentId, array $params = []): mixed
    {
        return $this->client->get($this->documentType."/$documentId/kb_position_discount", $params);
    }

    public function showDiscountPosition(int $documentId, int $itemId): mixed
    {
        return $this->client->get($this->documentType."/$documentId/kb_position_discount/$itemId");
    }

    public function createDiscountPosition(int $documentId, array $params = []): mixed
    {
        return $this->client->post($this->documentType."/$documentId/kb_position_discount", $params);
    }

    public function editDiscountPosition(int $documentId, int $itemId, array $params = []): mixed
    {
        return $this->client->post($this->documentType."/$documentId/kb_position_discount/$itemId", $params);
    }

    public function overwriteDiscountPosition(int $documentId, int $itemId, array $params = []): mixed
    {
        return $this->client->put($this->documentType."/$documentId/kb_position_discount/$itemId", $params);
    }

    public function deleteDiscountPosition(int $documentId, int $itemId): mixed
    {
        return $this->client->delete($this->documentType."/$documentId/kb_position_discount/$itemId");
    }
}
