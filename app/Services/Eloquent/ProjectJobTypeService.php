<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IProjectJobTypeService;
use App\Models\Eloquent\ProjectJobType;
use App\Services\ServiceResponse;

class ProjectJobTypeService implements IProjectJobTypeService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All project job types',
            200,
            ProjectJobType::all()
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
        $projectJobType = ProjectJobType::find($id);
        if ($projectJobType) {
            return new ServiceResponse(
                true,
                'Project job type',
                200,
                $projectJobType
            );
        } else {
            return new ServiceResponse(
                false,
                'Project job type not found',
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
        $projectJobType = $this->getById($id);
        if ($projectJobType->isSuccess()) {
            return new ServiceResponse(
                true,
                'Project job type deleted',
                200,
                $projectJobType->getData()->delete()
            );
        } else {
            return $projectJobType;
        }
    }
}
