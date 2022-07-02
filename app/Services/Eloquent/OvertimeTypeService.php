<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IOvertimeTypeService;
use App\Models\Eloquent\OvertimeType;

class OvertimeTypeService implements IOvertimeTypeService
{
    public function getAll()
    {
        return OvertimeType::all();
    }

    public function getById(
        int $id
    )
    {
        return OvertimeType::find($id);
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }
}
