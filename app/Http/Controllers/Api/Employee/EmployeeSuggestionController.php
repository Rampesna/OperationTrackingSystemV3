<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\EmployeeSuggestionController\GetByEmployeeIdRequest;
use App\Http\Requests\Api\Employee\EmployeeSuggestionController\GetByIdRequest;
use App\Http\Requests\Api\Employee\EmployeeSuggestionController\CreateRequest;
use App\Http\Requests\Api\Employee\EmployeeSuggestionController\UpdateRequest;
use App\Http\Requests\Api\Employee\EmployeeSuggestionController\DeleteRequest;
use App\Interfaces\Eloquent\IEmployeeSuggestionService;
use App\Traits\Response;

class EmployeeSuggestionController extends Controller
{
    use Response;

    /**
     * @var $employeeSuggestionService
     */
    private $employeeSuggestionService;

    /**
     * @param IEmployeeSuggestionService $employeeSuggestionService
     */
    public function __construct(IEmployeeSuggestionService $employeeSuggestionService)
    {
        $this->employeeSuggestionService = $employeeSuggestionService;
    }

    /**
     * @param GetByEmployeeIdRequest $request
     */
    public function getByEmployeeId(GetByEmployeeIdRequest $request)
    {
        $getByEmployeeIdResponse = $this->employeeSuggestionService->getByEmployeeId(
            $request->user()->id,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        );
        if ($getByEmployeeIdResponse->isSuccess()) {
            return $this->success(
                $getByEmployeeIdResponse->getMessage(),
                $getByEmployeeIdResponse->getData(),
                $getByEmployeeIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByEmployeeIdResponse->getMessage(),
                $getByEmployeeIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->employeeSuggestionService->getById(
            $request->id
        );
        if ($getByIdResponse->isSuccess()) {
            return $this->success(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getData(),
                $getByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->employeeSuggestionService->create(
            $request->user()->id,
            $request->subject,
            $request->description
        );
        if ($createResponse->isSuccess()) {
            return $this->success(
                $createResponse->getMessage(),
                $createResponse->getData(),
                $createResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $createResponse->getMessage(),
                $createResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $updateResponse = $this->employeeSuggestionService->update(
            $request->id,
            $request->subject,
            $request->description
        );
        if ($updateResponse->isSuccess()) {
            return $this->success(
                $updateResponse->getMessage(),
                $updateResponse->getData(),
                $updateResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateResponse->getMessage(),
                $updateResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->employeeSuggestionService->delete(
            $request->id
        );
        if ($deleteResponse->isSuccess()) {
            return $this->success(
                $deleteResponse->getMessage(),
                $deleteResponse->getData(),
                $deleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $deleteResponse->getMessage(),
                $deleteResponse->getStatusCode()
            );
        }
    }
}
