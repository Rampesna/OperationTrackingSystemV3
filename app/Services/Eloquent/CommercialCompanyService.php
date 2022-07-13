<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ICommercialCompanyService;
use App\Models\Eloquent\CommercialCompany;
use App\Services\ServiceResponse;

class CommercialCompanyService implements ICommercialCompanyService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All commercial companies',
            200,
            CommercialCompany::all()
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $commercialCompany = CommercialCompany::find($id);
        if ($commercialCompany) {
            return new ServiceResponse(
                true,
                'Commercial company',
                200,
                $commercialCompany
            );
        } else {
            return new ServiceResponse(
                false,
                'Commercial company not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function delete(
        int $id
    ): ServiceResponse
    {
        $commercialCompany = $this->getById($id);
        if ($commercialCompany->isSuccess()) {
            return new ServiceResponse(
                true,
                'Commercial company deleted',
                200,
                $commercialCompany->getData()->delete()
            );
        } else {
            return new ServiceResponse(
                false,
                'Commercial company not found',
                404,
                null
            );
        }
    }

    /**
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        string $name
    ): ServiceResponse
    {
        $commercialCompany = new CommercialCompany;
        $commercialCompany->name = $name;
        $commercialCompany->save();

        return new ServiceResponse(
            true,
            'Commercial company created',
            201,
            $commercialCompany
        );
    }

    /**
     * @param int $id
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name
    ): ServiceResponse
    {
        $getCommercialCompany = $this->getById($id);
        if ($getCommercialCompany->isSuccess()) {
            $getCommercialCompany->getData()->name = $name;
            $getCommercialCompany->getData()->save();

            return new ServiceResponse(
                true,
                'Commercial company updated',
                200,
                $getCommercialCompany->getData()
            );
        } else {
            return new ServiceResponse(
                false,
                'Commercial company not found',
                404,
                null
            );
        }
    }

}
