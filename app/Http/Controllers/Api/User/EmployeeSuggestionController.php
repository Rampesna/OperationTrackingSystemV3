<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\EmployeeSuggestionController\IndexRequest;
use App\Http\Requests\Api\User\EmployeeSuggestionController\GetByCompanyIdsRequest;
use App\Http\Requests\Api\User\EmployeeSuggestionController\GetByIdRequest;
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
     * @param IndexRequest $request
     */
    public function index(IndexRequest $request)
    {
        $indexResponse = $this->employeeSuggestionService->index(
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        );
        if ($indexResponse->isSuccess()) {
            return $this->success(
                $indexResponse->getMessage(),
                $indexResponse->getData(),
                $indexResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $indexResponse->getMessage(),
                $indexResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByCompanyIdsRequest $request
     */
    public function getByCompanyIds(GetByCompanyIdsRequest $request)
    {
        $indexResponse = $this->employeeSuggestionService->getByCompanyIds(
            $request->companyIds,
            $request->pageIndex,
            $request->pageSize,
            $request->keyword
        );
        if ($indexResponse->isSuccess()) {
            return $this->success(
                $indexResponse->getMessage(),
                $indexResponse->getData(),
                $indexResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $indexResponse->getMessage(),
                $indexResponse->getStatusCode()
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
}
