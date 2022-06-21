<?php

namespace App\Interfaces\Eloquent;

interface IBoardService extends IEloquentService
{
    /**
     * @param array $boards
     */
    public function updateOrder(
        array $boards
    );
}
