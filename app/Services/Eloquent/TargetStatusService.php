<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IEloquentService;
use App\Interfaces\Eloquent\ITargetStatusService;
use App\Models\Eloquent\TargetStatus;
use App\Services\ServiceResponse;

class TargetStatusService implements ITargetStatusService
{

    public function getAll(): ServiceResponse
    {
       $targetStatuses = TargetStatus::all();
         return new ServiceResponse(true, 'Target statuses retrieved successfully', 200, $targetStatuses);
    }

    public function getById(int $id): ServiceResponse
    {
        // TODO: Implement getById() method.
    }

    public function delete(int $id): ServiceResponse
    {
        // TODO: Implement delete() method.
    }
}
