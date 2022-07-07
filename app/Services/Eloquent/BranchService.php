<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IBranchService;
use App\Models\Eloquent\Branch;
use App\Services\ServiceResponse;

class BranchService implements IBranchService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All branches',
            200,
            Branch::all()
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
        return new ServiceResponse(
            true,
            'Branch',
            200,
            Branch::find($id)
        );
    }

    /**
     * @param int $companyId
     *
     * @return ServiceResponse
     */
    public function getByCompanyId(
        int $companyId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Branches',
            200,
            Branch::where('company_id', $companyId)->get()
        );
    }

    /**
     * @param int $companyId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        int    $companyId,
        string $name
    ): ServiceResponse
    {
        $branch = new Branch;
        $branch->company_id = $companyId;
        $branch->name = $name;
        $branch->save();

        return new ServiceResponse(
            true,
            'Branch created',
            200,
            $branch
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
        $getBranch = $this->getById($id);
        if ($getBranch->isSuccess()) {
            $getBranch->getData()->name = $name;
            $getBranch->getData()->save();

            return new ServiceResponse(
                true,
                'Branch not found',
                404,
                $getBranch->getData()
            );
        } else {
            return new ServiceResponse(
                false,
                'Branch not found',
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
        $getBranch = $this->getById($id);
        if ($getBranch->isSuccess()) {
            $getBranch->getData()->delete();

            return new ServiceResponse(
                true,
                'Branch deleted',
                200,
                null
            );
        } else {
            return new ServiceResponse(
                false,
                'Branch not found',
                404,
                null
            );
        }
    }

}
