<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IProjectService;
use App\Http\Requests\Api\User\ProjectController\GetByUserIdRequest;
use App\Traits\Response;

class ProjectController extends Controller
{
    use Response;

    private $projectService;

    public function __construct(IProjectService $projectService)
    {
        $this->projectService = $projectService;
    }

    public function getByUserId(GetByUserIdRequest $request)
    {
        return $this->success('Projects', $this->projectService->getByProjectIds(
            $request->user()->projects()->pluck('id')->toArray()
        ));
    }
}
