<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IProjectLandingCustomerService;
use App\Models\Eloquent\ProjectLandingCustomer;
use App\Services\ServiceResponse;

class ProjectLandingCustomerService implements IProjectLandingCustomerService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All project landing customers',
            200,
            ProjectLandingCustomer::all()
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
        $projectLandingCustomer = ProjectLandingCustomer::find($id);
        if ($projectLandingCustomer) {
            return new ServiceResponse(
                true,
                'Project landing customer',
                200,
                $projectLandingCustomer
            );
        } else {
            return new ServiceResponse(
                false,
                'Project landing customer not found',
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
        $projectLandingCustomer = $this->getById($id);
        if ($projectLandingCustomer->isSuccess()) {
            return new ServiceResponse(
                true,
                'Project landing customer deleted',
                200,
                $projectLandingCustomer->getData()->delete()
            );
        } else {
            return $projectLandingCustomer;
        }
    }

    /**
     * @param int $projectId
     *
     * @return ServiceResponse
     */
    public function getAllByProjectId(
        int $projectId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Project landing customers',
            200,
            ProjectLandingCustomer::where('project_id', $projectId)->get()
        );
    }

    /**
     * @param int $projectId
     * @param array|null $customerIds
     *
     * @return ServiceResponse
     */
    public function updateByProjectId(
        int    $projectId,
        ?array $customerIds = []
    ): ServiceResponse
    {
        ProjectLandingCustomer::where('project_id', $projectId)->delete();
        foreach ($customerIds ?? [] as $customerId) {
            $projectLandingCustomer = new ProjectLandingCustomer;
            $projectLandingCustomer->project_id = $projectId;
            $projectLandingCustomer->customer_id = $customerId;
            $projectLandingCustomer->save();
        }
        return new ServiceResponse(
            true,
            'Project landing customers updated',
            200,
            ProjectLandingCustomer::where('project_id', $projectId)->get()
        );
    }
}
