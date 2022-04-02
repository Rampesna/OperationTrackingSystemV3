<?php

namespace App\Interfaces\Eloquent;

interface IEloquentService
{
    public function getAll();

    /**
     * @param int $id
     */
    public function getById(
        int $id
    );

    /**
     * @param int $id
     */
    public function delete(
        int $id
    );
}
