<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IDepartmentService;
use App\Models\Eloquent\Department;

class DepartmentService implements IDepartmentService
{
    public function getAll()
    {
        return Department::all();
    }

    public function getById(
        int $id
    )
    {
        return Department::find($id);
    }

    public function getByBranchId(
        int $branchId
    )
    {
        return Department::where('branch_id', $branchId)->get();
    }

    public function create(
        int    $branchId,
        string $name
    )
    {
        $department = new Department;
        $department->branch_id = $branchId;
        $department->name = $name;
        $department->save();

        return $department;
    }

    public function update(
        int    $id,
        string $name
    )
    {
        $department = $this->getById($id);
        $department->name = $name;
        $department->save();

        return $department;
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }

}
