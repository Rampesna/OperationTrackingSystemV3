<?php

namespace App\Interfaces\Eloquent;

interface IBoardService extends IEloquentService
{
    /**
     * @param array $boardList
     */
    public function updateOrder(
        array $boardList
    );
}
