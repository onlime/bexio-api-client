<?php

namespace Bexio\Resource;

use Bexio\Bexio;

class Note extends Bexio
{
    /**
     * Gets all Notes
     */
    public function getNotes(array $params = []): mixed
    {
        return $this->client->get('note', $params);
    }

    /**
     * Search for notes
     */
    public function searchNotes(array $params = [], array $queryParams = []): mixed
    {
        return $this->client->post('note/search', $params, $queryParams);
    }

    /**
     * Get specific note
     */
    public function getNote(int $id): mixed
    {
        return $this->client->get("note/$id");
    }

    /**
     * Add new note
     */
    public function createNote(array $params = []): mixed
    {
        return $this->client->post('note', $params);
    }

    /**
     * Edit note
     */
    public function editNote(int $id, array $params = []): mixed
    {
        return $this->client->post("note/$id", $params);
    }

    /**
     * Delete specific note
     */
    public function deleteNote(int $id): mixed
    {
        return $this->client->delete("note/$id");
    }
}
