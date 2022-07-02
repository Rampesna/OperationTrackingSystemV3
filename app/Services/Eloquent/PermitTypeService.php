<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPermitTypeService;
use App\Models\Eloquent\PermitType;

class PermitTypeService implements IPermitTypeService
{
    public function getAll()
    {
        return PermitType::all();
    }

    public function getById(
        int $id
    )
    {
        return PermitType::find($id);
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }
}
