<?php

namespace Bexio\Resource;

use Bexio\Bexio;

/**
 * Class Note
 */
class Note extends Bexio
{
    /**
     * Gets all Notes
     *
     * @return array
     */
    public function getNotes(array $params = [])
    {
        return $this->client->get('note', $params);
    }

    /**
     * Search for notes
     *
     * @return mixed
     */
    public function searchNotes(array $params = [], array $queryParams = [])
    {
        return $this->client->post('note/search', $params, $queryParams);
    }

    /**
     * Get specific note
     *
     * @return mixed
     */
    public function getNote(int $id)
    {
        return $this->client->get("note/$id");
    }

    /**
     * Add new note
     *
     * @return mixed
     */
    public function createNote(array $params = [])
    {
        return $this->client->post('note', $params);
    }

    /**
     * Edit note
     *
     * @return mixed
     */
    public function editNote(int $id, array $params = [])
    {
        return $this->client->post("note/$id", $params);
    }

    /**
     * Delete specific note
     *
     * @return mixed
     */
    public function deleteNote(int $id)
    {
        return $this->client->delete("note/$id");
    }
}
