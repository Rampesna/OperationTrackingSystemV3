<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\ITitleService;
use App\Http\Requests\Api\User\TitleController\GetAllRequest;
use App\Http\Requests\Api\User\TitleController\GetByIdRequest;
use App\Http\Requests\Api\User\TitleController\GetByDepartmentIdRequest;
use App\Http\Requests\Api\User\TitleController\CreateRequest;
use App\Http\Requests\Api\User\TitleController\UpdateRequest;
use App\Http\Requests\Api\User\TitleController\DeleteRequest;
use App\Traits\Response;

class TitleController extends Controller
{
    use Response;

    private $titleService;

    public function __construct(ITitleService $titleService)
    {
        $this->titleService = $titleService;
    }

    public function getAll(GetAllRequest $request)
    {
        return $this->success('Titles', $this->titleService->getAll());
    }

    public function getById(GetByIdRequest $request)
    {
        return $this->success('Title', $this->titleService->getById(
            $request->id
        ));
    }

    public function getByDepartmentId(GetByDepartmentIdRequest $request)
    {
        return $this->success('Titles', $this->titleService->getByDepartmentId(
            $request->departmentId
        ));
    }

    public function create(CreateRequest $request)
    {
        return $this->success('Title created', $this->titleService->create(
            $request->departmentId,
            $request->name
        ));
    }

    public function update(UpdateRequest $request)
    {
        return $this->success('Title updated', $this->titleService->update(
            $request->id,
            $request->name
        ));
    }

    public function delete(DeleteRequest $request)
    {
        return $this->success('Title deleted', $this->titleService->delete(
            $request->id
        ));
    }
}
