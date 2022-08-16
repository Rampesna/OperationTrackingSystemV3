<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IProjectJobService;
use App\Models\Eloquent\ProjectJob;
use App\Services\ServiceResponse;

class ProjectJobService implements IProjectJobService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All project jobs',
            200,
            ProjectJob::all()
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
        $projectJob = ProjectJob::find($id);
        if ($projectJob) {
            return new ServiceResponse(
                true,
                'Project job',
                200,
                $projectJob
            );
        } else {
            return new ServiceResponse(
                false,
                'Project job not found',
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
        $projectJob = $this->getById($id);
        if ($projectJob->isSuccess()) {
            return new ServiceResponse(
                true,
                'Project job deleted',
                200,
                $projectJob->getData()->delete()
            );
        } else {
            return $projectJob;
        }
    }

    /**
     * @param int $projectId
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getByProjectId(
        int     $projectId,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null
    ): ServiceResponse
    {
        $projectJobs = ProjectJob::with([
            'creator',
            'type'
        ])->where('project_id', $projectId);

        if ($keyword) {
            $projectJobs = $projectJobs->where(function ($query) use ($keyword) {
                $query->where('code', 'like', '%' . $keyword . '%')
                    ->orWhere('subject', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        return new ServiceResponse(
            true,
            'Project versions',
            200,
            [
                'totalCount' => $projectJobs->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'projectJobs' => $projectJobs->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $projectId
     * @param int|null $creatorId
     * @param int|null $landingCustomerId
     * @param int $typeId
     * @param string $code
     * @param string $subject
     * @param string|null $description
     * @param string|null $image
     * @param string|null $startDate
     * @param string|null $endDate
     *
     * @return ServiceResponse
     */
    public function create(
        int     $projectId,
        ?int    $creatorId,
        ?int    $landingCustomerId,
        int     $typeId,
        string  $code,
        string  $subject,
        ?string $description = null,
        ?string $image = null,
        ?string $startDate = null,
        ?string $endDate = null
    ): ServiceResponse
    {
        $projectJob = new ProjectJob();
        $projectJob->project_id = $projectId;
        $projectJob->creator_id = $creatorId;
        $projectJob->landing_customer_id = $landingCustomerId;
        $projectJob->type_id = $typeId;
        $projectJob->code = $code;
        $projectJob->subject = $subject;
        $projectJob->description = $description;
        $projectJob->image = $image;
        $projectJob->start_date = $startDate;
        $projectJob->end_date = $endDate;
        $projectJob->save();
        return new ServiceResponse(
            true,
            'Project job created',
            201,
            $projectJob
        );
    }

    /**
     * @param int $id
     * @param int $projectId
     * @param int|null $creatorId
     * @param int|null $landingCustomerId
     * @param int $typeId
     * @param string $code
     * @param string $subject
     * @param string|null $description
     * @param string|null $image
     * @param string|null $startDate
     * @param string|null $endDate
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        int     $projectId,
        ?int    $creatorId,
        ?int    $landingCustomerId,
        int     $typeId,
        string  $code,
        string  $subject,
        ?string $description = null,
        ?string $image = null,
        ?string $startDate = null,
        ?string $endDate = null
    ): ServiceResponse
    {
        $projectJob = $this->getById($id);
        if ($projectJob->isSuccess()) {
            $projectJob->getData()->project_id = $projectId;
            $projectJob->getData()->creator_id = $creatorId;
            $projectJob->getData()->landing_customer_id = $landingCustomerId;
            $projectJob->getData()->type_id = $typeId;
            $projectJob->getData()->code = $code;
            $projectJob->getData()->subject = $subject;
            $projectJob->getData()->description = $description;
            $projectJob->getData()->image = $image;
            $projectJob->getData()->start_date = $startDate;
            $projectJob->getData()->end_date = $endDate;
            $projectJob->getData()->save();
            return new ServiceResponse(
                true,
                'Project job updated',
                200,
                $projectJob->getData()
            );
        } else {
            return $projectJob;
        }
    }
}
