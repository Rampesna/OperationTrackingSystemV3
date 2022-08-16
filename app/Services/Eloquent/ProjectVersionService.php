<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IProjectVersionService;
use App\Models\Eloquent\ProjectVersion;
use App\Services\ServiceResponse;

class ProjectVersionService implements IProjectVersionService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All project versions',
            200,
            ProjectVersion::all()
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
        $projectVersion = ProjectVersion::find($id);
        if ($projectVersion) {
            return new ServiceResponse(
                true,
                'Project version',
                200,
                $projectVersion
            );
        } else {
            return new ServiceResponse(
                false,
                'Project version not found',
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
        $projectVersion = $this->getById($id);
        if ($projectVersion->isSuccess()) {
            return new ServiceResponse(
                true,
                'Project version deleted',
                200,
                $projectVersion->getData()->delete()
            );
        } else {
            return $projectVersion;
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
        $projectVersions = ProjectVersion::where('project_id', $projectId);

        if ($keyword) {
            $projectVersions = $projectVersions->where(function ($query) use ($keyword) {
                $query->where('title', 'like', '%' . $keyword . '%')
                    ->orWhere('version', 'like', '%' . $keyword . '%')
                    ->orWhere('description', 'like', '%' . $keyword . '%');
            });
        }

        return new ServiceResponse(
            true,
            'Project versions',
            200,
            [
                'totalCount' => $projectVersions->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'projectVersions' => $projectVersions->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $projectId
     * @param string $title
     * @param string $versionString
     * @param string|null $description
     *
     * @return ServiceResponse
     */
    public function create(
        int     $projectId,
        string  $title,
        string  $versionString,
        ?string $description = null
    ): ServiceResponse
    {
        $projectVersion = new ProjectVersion();
        $projectVersion->project_id = $projectId;
        $projectVersion->title = $title;
        $projectVersion->version = $versionString;
        $projectVersion->description = $description;
        $projectVersion->save();
        return new ServiceResponse(
            true,
            'Project version created',
            201,
            $projectVersion
        );
    }

    /**
     * @param int $id
     * @param string $title
     * @param string $versionString
     * @param string|null $description
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        string  $title,
        string  $versionString,
        ?string $description = null
    ): ServiceResponse
    {
        $projectVersion = $this->getById($id);
        if ($projectVersion->isSuccess()) {
            $projectVersion->getData()->title = $title;
            $projectVersion->getData()->version = $versionString;
            $projectVersion->getData()->description = $description;
            $projectVersion->getData()->save();
            return new ServiceResponse(
                true,
                'Project version updated',
                200,
                $projectVersion->getData()
            );
        } else {
            return $projectVersion;
        }
    }
}
