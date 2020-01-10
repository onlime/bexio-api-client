<?php

namespace Bexio\Contract;

interface ItemPosition
{
    public function listItemPositions(int $parentId, array $params = []);
    public function showItemPosition(int $parentId, int $itemId);
    public function createItemPosition(int $parentId, array $params = []);
    public function editItemPosition(int $parentId, int $itemId, array $params = []);
    public function deleteItemPosition(int $parentId, int $itemId);
}
