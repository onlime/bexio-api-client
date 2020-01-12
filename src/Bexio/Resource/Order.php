<?php
namespace Bexio\Resource;

use Bexio\Bexio;
use Bexio\Contract\ItemPosition;

/**
 * Class Order
 * @package Bexio\Resource
 * https://docs.bexio.com/ressources/kb_order/
 */
class Order extends Bexio implements ItemPosition
{
    /**
     * Gets all orders
     * https://docs.bexio.com/ressources/kb_order/#list-orders
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
     * https://docs.bexio.com/ressources/kb_order/#search-orders
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
        return $this->client->get('kb_order/' . $id, []);
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
        return $this->client->post('kb_order/'. $id, $params);
    }

    /**
     * Delete order
     *
     * @param $id
     * @return mixed
     */
    public function deleteOrder(int $id)
    {
        return $this->client->delete('kb_order/' . $id, []);
    }

    /**
     * Get repetition
     *
     * @param $id
     * @return mixed
     */
    public function getRepetition(int $id)
    {
        return $this->client->get('kb_order/' . $id . '/repetition', []);
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
        return $this->client->post('kb_order/' . $id . '/repetition', $params);
    }

    /**
     * Delete repetition
     *
     * @param $id
     * @return mixed
     */
    public function deleteRepetition(int $id)
    {
        return $this->client->delete('kb_order/' . $id . '/repetition', []);
    }

    /**
     * @param int   $parentId
     * @param array $params
     * @return mixed
     */
    public function listItemPositions(int $parentId, array $params = [])
    {
        return $this->client->get('kb_order/' . $parentId . '/kb_position_article', $params);
    }

    /**
     * @param int $parentId
     * @param int $itemId
     * @return mixed
     */
    public function showItemPosition(int $parentId, int $itemId)
    {
        return $this->client->get('kb_order/' . $parentId . '/kb_position_article/' . $itemId);
    }

    /**
     * @param int $parentId
     * @param array $params
     * @return mixed
     */
    public function createItemPosition(int $parentId, array $params = [])
    {
        return $this->client->post('kb_order/' . $parentId . '/kb_position_article', $params);
    }

    /**
     * @param int $parentId
     * @param int $itemId
     * @param array $params
     * @return mixed
     */
    public function editItemPosition(int $parentId, int $itemId, array $params = [])
    {
        return $this->client->post('kb_order/' . $parentId . '/kb_position_article/' . $itemId, $params);
    }

    /**
     * @param int $parentId
     * @param int $itemId
     * @param array $params
     * @return mixed
     */
    public function overwriteItemPosition(int $parentId, int $itemId, array $params = [])
    {
        return $this->client->put('kb_order/' . $parentId . '/kb_position_article/' . $itemId, $params);
    }

    /**
     * @param int $parentId
     * @param int $itemId
     * @return mixed
     */
    public function deleteItemPosition(int $parentId, int $itemId)
    {
        return $this->client->delete('kb_order/' . $parentId . '/kb_position_article/' . $itemId);
    }

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function createInvoice(int $id, array $params = [])
    {
        return $this->client->post('kb_order/' . $id . '/invoice', $params);
    }

    /**
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function createInvoiceWithAllOpenPositions(int $id)
    {
        return $this->client->postWithoutPayload('kb_order/' . $id . '/invoice');
    }

    /**
     * Get specific order PDF
     *
     * @param int $id
     * @return mixed
     */
    public function getPdf(int $id)
    {
        return $this->client->get('kb_order/' . $id . '/pdf');
    }

    /**
     * Get comments
     *
     * @param int $id
     * @return mixed
     */
    public function getComments(int $id)
    {
        return $this->client->get('kb_order/' . $id . '/comment');
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
        return $this->client->get('kb_order/' . $id . '/comment/' . $commentId);
    }

    /**
     * Create comment
     * https://docs.bexio.com/ressources/kb_order/#create-comment
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function createComment(int $id, array $params = [])
    {
        return $this->client->post('kb_order/' . $id . '/comment', $params);
    }
}
