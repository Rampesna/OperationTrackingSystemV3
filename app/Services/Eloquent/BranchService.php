<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IBranchService;
use App\Models\Eloquent\Branch;

class BranchService implements IBranchService
{
    public function getAll()
    {
        return Branch::all();
    }

    public function getById(
        int $id
    )
    {
        return Branch::find($id);
    }

    public function getByCompanyId(
        int $companyId
    )
    {
        return Branch::where('company_id', $companyId)->get();
    }

    public function create(
        int    $companyId,
        string $name
    )
    {
        $branch = new Branch;
        $branch->company_id = $companyId;
        $branch->name = $name;
        $branch->save();

        return $branch;
    }

    public function update(
        int    $id,
        string $name
    )
    {
        $branch = $this->getById($id);
        $branch->name = $name;
        $branch->save();

        return $branch;
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }

}
