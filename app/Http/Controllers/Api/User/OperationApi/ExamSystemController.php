<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Interfaces\OperationApi\IExamSystemService;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\GetExamListRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\GetExamResultReadingListRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\GetExamResultReadingReplyListRequest;
use App\Traits\Response;

class ExamSystemController extends Controller
{
    use Response;

    /**
     * @var $examSystemService
     */
    private $examSystemService;

    /**
     * @param IExamSystemService $examSystemService
     */
    public function __construct(IExamSystemService $examSystemService,)
    {
        $this->examSystemService = $examSystemService;
    }

    /**
     * @param GetExamListRequest $request
     */
    public function getExamList(GetExamListRequest $request)
    {
        $getExamListResponse = $this->examSystemService->GetExamList();
        if ($getExamListResponse->isSuccess()) {
            return $this->success(
                $getExamListResponse->getMessage(),
                $getExamListResponse->getData(),
                $getExamListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getExamListResponse->getMessage(),
                $getExamListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetExamResultReadingListRequest $request
     */
    public function getExamResultReadingList(GetExamResultReadingListRequest $request)
    {
        $getExamResultReadingListResponse = $this->examSystemService->GetExamResultReadingList(
            $request->examId
        );
        if ($getExamResultReadingListResponse->isSuccess()) {
            return $this->success(
                $getExamResultReadingListResponse->getMessage(),
                $getExamResultReadingListResponse->getData(),
                $getExamResultReadingListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getExamResultReadingListResponse->getMessage(),
                $getExamResultReadingListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetExamResultReadingReplyListRequest $request
     */
    public function getExamResultReadingReplyList(GetExamResultReadingReplyListRequest $request)
    {
        $getExamResultReadingReplyListResponse = $this->examSystemService->GetExamResultReadingReplyList(
            $request->employeeGuid,
            $request->examId
        );
        if ($getExamResultReadingReplyListResponse->isSuccess()) {
            return $this->success(
                $getExamResultReadingReplyListResponse->getMessage(),
                $getExamResultReadingReplyListResponse->getData(),
                $getExamResultReadingReplyListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getExamResultReadingReplyListResponse->getMessage(),
                $getExamResultReadingReplyListResponse->getStatusCode()
            );
        }
    }
}
