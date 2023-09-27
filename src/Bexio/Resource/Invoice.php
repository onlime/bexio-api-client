<?php

namespace Bexio\Resource;

class Invoice extends AbstractDocumentPositions
{
    protected $documentType = 'kb_invoice';

    /**
     * Gets all orders
     */
    public function getInvoices(array $params = []): mixed
    {
        return $this->client->get('kb_invoice', $params);
    }

    /**
     * Search for invoices
     */
    public function searchInvoices(array $params = [], array $queryParams = []): mixed
    {
        return $this->client->post('kb_invoice/search', $params, $queryParams);
    }

    /**
     * Get specific invoice
     */
    public function getInvoice(int $id): mixed
    {
        return $this->client->get("kb_invoice/$id");
    }

    /**
     * Get specific invoice PDF
     */
    public function getPdf(int $id): mixed
    {
        return $this->client->get("kb_invoice/$id/pdf");
    }

    /**
     * Add new invoice
     */
    public function createInvoice(array $params = []): mixed
    {
        return $this->client->post('kb_invoice', $params);
    }

    /**
     * Edit invoice
     */
    public function editInvoice(int $id, array $params = []): mixed
    {
        return $this->client->post("kb_invoice/$id", $params);
    }

    /**
     * Delete invoice
     */
    public function deleteInvoice(int $id): mixed
    {
        return $this->client->delete("kb_invoice/$id");
    }

    /**
     * Issue specific invoice
     */
    public function issueInvoice(int $id): mixed
    {
        return $this->client->post("kb_invoice/$id/issue");
    }

    /**
     * Send specific invoice
     */
    public function sendInvoice(int $id, array $params = []): mixed
    {
        return $this->client->post("kb_invoice/$id/send", $params);
    }

    /**
     * Mark specific invoice as sent
     */
    public function markInvoiceAsSent(int $id): mixed
    {
        return $this->client->post("kb_invoice/$id/mark_as_sent");
    }

    /**
     * Get comments
     */
    public function getComments(int $id): mixed
    {
        return $this->client->get("kb_invoice/$id/comment");
    }

    /**
     * Get specific comment
     */
    public function getComment(int $id, int $commentId): mixed
    {
        return $this->client->get("kb_invoice/$id/comment/$commentId");
    }

    /**
     * Create comment
     */
    public function createComment(int $id, array $params = []): mixed
    {
        return $this->client->post("kb_invoice/$id/comment", $params);
    }

    /**
     * Fetches a list of all payments for the invoice
     */
    public function getInvoicePayments(int $id, array $params = []): mixed
    {
        return $this->client->get("kb_invoice/$id/payment", $params);
    }

    /**
     * Get specific invoice payment
     */
    public function getInvoicePayment(int $id, int $paymentId): mixed
    {
        return $this->client->get("kb_invoice/$id/payment/$paymentId");
    }

    /**
     * Create a new invoice payment
     */
    public function createInvoicePayment(int $id, array $params = []): mixed
    {
        return $this->client->post("kb_invoice/$id/payment", $params);
    }

    /**
     * Delete an invoice payment
     */
    public function deleteInvoicePayment(int $id, int $paymentId): mixed
    {
        return $this->client->delete("kb_invoice/$id/payment/$paymentId");
    }

    /**
     * Fetches a list of all reminders for the invoice
     */
    public function getInvoiceReminders(int $id): mixed
    {
        return $this->client->get("kb_invoice/$id/kb_reminder");
    }

    /**
     * Get specific invoice reminder
     */
    public function getInvoiceReminder(int $id, int $reminderId): mixed
    {
        return $this->client->get("kb_invoice/$id/kb_reminder/$reminderId");
    }

    /**
     * Create a new reminder for an invoice. Raises reminder_level by 1.
     */
    public function createInvoiceReminder(int $id): mixed
    {
        return $this->client->post("kb_invoice/$id/kb_reminder");
    }

    /**
     * Delete an invoice reminder
     */
    public function deleteInvoiceReminder(int $id, int $reminderId): mixed
    {
        return $this->client->delete("kb_invoice/$id/kb_reminder/$reminderId");
    }
}
