<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IProjectService;
use App\Models\Eloquent\Project;

class ProjectService implements IProjectService
{
    public function getAll()
    {
        return Project::with([

        ])->all();
    }

    public function getById(
        int $id
    )
    {
        return Project::with([

        ])->findOrFail($id);
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }

    public function getByCompanyIds(
        array $companyIds
    )
    {
        return Project::with([

        ])->whereIn('company_id', $companyIds)->get();
    }
    
    public function getByProjectIds(
        array $projectIds
    )
    {
        return Project::with([

        ])->whereIn('id', $projectIds)->get();
    }
}
