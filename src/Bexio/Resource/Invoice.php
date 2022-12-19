<?php

namespace Bexio\Resource;

use Bexio\Resource\AbstractDocumentPositions;

/**
 * Class Invoice
 */
class Invoice extends AbstractDocumentPositions
{
    protected $documentType = 'kb_invoice';

    /**
     * Gets all orders
     *
     * @return array
     */
    public function getInvoices(array $params = [])
    {
        return $this->client->get('kb_invoice', $params);
    }

    /**
     * Search for invoices
     *
     * @param array $params
     * @param array $queryParams
     * @return mixed
     */
    public function searchInvoices(array $params = [], array $queryParams = [])
    {
        return $this->client->post('kb_invoice/search', $params, $queryParams);
    }

    /**
     * Get specific invoice
     *
     * @param int $id
     * @return mixed
     */
    public function getInvoice(int $id)
    {
        return $this->client->get("kb_invoice/$id");
    }

    /**
     * Get specific invoice PDF
     *
     * @param int $id
     * @return mixed
     */
    public function getPdf(int $id)
    {
        return $this->client->get("kb_invoice/$id/pdf");
    }

    /**
     * Add new invoice
     *
     * @param array $params
     * @return mixed
     */
    public function createInvoice(array $params = [])
    {
        return $this->client->post('kb_invoice', $params);
    }

    /**
     * Edit invoice
     *
     * @param int   $id
     * @param array $params
     * @return mixed
     */
    public function editInvoice(int $id, array $params = [])
    {
        return $this->client->post("kb_invoice/$id", $params);
    }

    /**
     * Delete invoice
     *
     * @param int $id
     * @return mixed
     */
    public function deleteInvoice(int $id)
    {
        return $this->client->delete("kb_invoice/$id");
    }

    /**
     * Issue specific invoice
     *
     * @param int $id
     * @return mixed
     */
    public function issueInvoice(int $id)
    {
        return $this->client->post("kb_invoice/$id/issue");
    }

    /**
     * Send specific invoice
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function sendInvoice(int $id, array $params = [])
    {
        return $this->client->post("kb_invoice/$id/send", $params);
    }

    /**
     * Mark specific invoice as sent
     *
     * @param int $id
     * @return mixed
     */
    public function markInvoiceAsSent(int $id)
    {
        return $this->client->post("kb_invoice/$id/mark_as_sent");
    }

    /**
     * Get comments
     *
     * @param int $id
     * @return mixed
     */
    public function getComments(int $id)
    {
        return $this->client->get("kb_invoice/$id/comment");
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
        return $this->client->get("kb_invoice/$id/comment/$commentId");
    }

    /**
     * Create comment
     *
     * @param int   $id
     * @param array $params
     * @return mixed
     */
    public function createComment(int $id, array $params = [])
    {
        return $this->client->post("kb_invoice/$id/comment", $params);
    }

    /**
     * Fetches a list of all payments for the invoice
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function getInvoicePayments(int $id, array $params = [])
    {
        return $this->client->get("kb_invoice/$id/payment", $params);
    }

    /**
     * Get specific invoice payment
     *
     * @param int $id
     * @param int $paymentId
     * @return mixed
     */
    public function getInvoicePayment(int $id, int $paymentId)
    {
        return $this->client->get("kb_invoice/$id/payment/$paymentId");
    }

    /**
     * Create a new invoice payment
     *
     * @param int $id
     * @param array $params
     * @return mixed
     */
    public function createInvoicePayment(int $id, array $params = [])
    {
        return $this->client->post("kb_invoice/$id/payment", $params);
    }

    /**
     * Delete an invoice payment
     *
     * @param int $id
     * @param int $paymentId
     * @return mixed
     */
    public function deleteInvoicePayment(int $id, int $paymentId)
    {
        return $this->client->delete("kb_invoice/$id/payment/$paymentId");
    }

    /**
     * Fetches a list of all reminders for the invoice
     *
     * @param int $id
     * @return mixed
     */
    public function getInvoiceReminders(int $id)
    {
        return $this->client->get("kb_invoice/$id/kb_reminder");
    }

    /**
     * Get specific invoice reminder
     *
     * @param int $id
     * @param int $reminderId
     * @return mixed
     */
    public function getInvoiceReminder(int $id, int $reminderId)
    {
        return $this->client->get("kb_invoice/$id/kb_reminder/$reminderId");
    }

    /**
     * Create a new reminder for an invoice. Raises reminder_level by 1.
     *
     * @param int $id
     * @return mixed
     */
    public function createInvoiceReminder(int $id)
    {
        return $this->client->post("kb_invoice/$id/kb_reminder");
    }

    /**
     * Delete an invoice reminder
     *
     * @param int $id
     * @param int $reminderId
     * @return mixed
     */
    public function deleteInvoiceReminder(int $id, int $reminderId)
    {
        return $this->client->delete("kb_invoice/$id/kb_reminder/$reminderId");
    }
}
