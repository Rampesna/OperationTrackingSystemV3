<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ICommercialCompanyService;
use App\Models\Eloquent\CommercialCompany;

class CommercialCompanyService implements ICommercialCompanyService
{
    public function getAll()
    {
        return CommercialCompany::all();
    }

    public function getById(
        int $id
    )
    {
        return CommercialCompany::find($id);
    }

    public function delete(
        int $id
    )
    {
        return CommercialCompany::destroy($id);
    }

    public function create(
        string $name
    )
    {
        $commercialCompany = new CommercialCompany;
        $commercialCompany->name = $name;
        $commercialCompany->save();

        return $commercialCompany;
    }

    public function update(
        int    $id,
        string $name
    )
    {
        $commercialCompany = $this->getById($id);
        $commercialCompany->name = $name;
        $commercialCompany->save();

        return $commercialCompany;
    }

}
