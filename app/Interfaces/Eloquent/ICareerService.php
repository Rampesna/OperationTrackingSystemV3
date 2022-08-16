<?php

namespace App\Interfaces\Eloquent;

use App\Services\ServiceResponse;

interface ICareerService extends IEloquentService
{
    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     */
    public function index(
        int     $pageIndex = 0,
        int     $pageSize = 10,
        ?string $keyword = null
    ): ServiceResponse;

    /**
     * @param string $name
     * @param string $identity
     * @param string $email
     * @param string $phone
     * @param string $department
     * @param mixed $cv
     */
    public function create(
        string $name,
        string $identity,
        string $email,
        string $phone,
        string $department,
        mixed  $cv
    ): ServiceResponse;
}
