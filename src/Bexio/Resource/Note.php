<?php
namespace Bexio\Resource;

use Bexio\Bexio;

/**
 * Class Note
 * @package Bexio\Resource
 */
class Note extends Bexio
{
   /**
     * Gets all Notes
     *
     * @param array $params
     * @return array
     */
    public function getNotes(array $params = [])
    {
        return $this->client->get('note', $params);
    }

    /**
     * Search for notes
     *
     * @param array $params
     * @param array $queryParams
     * @return mixed
     */
    public function searchNotes(array $params = [], array $queryParams = [])
    {
        return $this->client->post('note/search', $params, $queryParams);
    }

    /**
     * Get specific note
     *
     * @param $id
     * @return mixed
     */
    public function getNote(int $id)
    {
        return $this->client->get("note/$id");
    }

    /**
     * Add new note
     * 
     * @param array $params
     * @return mixed
     */
    public function createNote(array $params = [])
    {
        return $this->client->post('note', $params);
    }

    /**
     * Edit note
     *
     * @param $id
     * @param array $params
     * @return mixed
     */
    public function editNote(int $id, array $params = [])
    {
        return $this->client->post("note/$id", $params);
    }

    /**
     * Delete specific note
     *
     * @param $id
     * @return mixed
     */
    public function deleteNote(int $id)
    {
        return $this->client->delete("note/$id");
    }
}
