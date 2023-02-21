<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ITargetTypeService;
use App\Models\Eloquent\TargetType;
use App\Services\ServiceResponse;

class TargetTypeService implements ITargetTypeService
{

    public function getAll(): ServiceResponse
    {
        $targetTypes = TargetType::all();
        return new ServiceResponse(true, 'Target types retrieved successfully', 200, $targetTypes);
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
