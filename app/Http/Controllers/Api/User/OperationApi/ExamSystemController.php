<?php

namespace App\Http\Controllers\Api\User\OperationApi;

use App\Http\Controllers\Controller;
use App\Interfaces\OperationApi\IExamSystemService;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\GetExamListRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\GetExamResultReadingListRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\GetExamResultReadingReplyListRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\SetExamResultReadingReplyRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\GetExamResultListRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\GetExamEditRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\GetQuestionsEditRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\GetQuestionOptionsEditRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\SetExamsRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\SetExamDeleteRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\SetQuestionsDeleteRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\SetQuestionOptionsDeleteRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\GetQuestionsListRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\GetQuestionOptionsListRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\SetQuestionsRequest;
use App\Http\Requests\Api\User\OperationApi\ExamSystemController\SetQuestionOptionsRequest;
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

    /**
     * @param SetExamResultReadingReplyRequest $request
     */
    public function setExamResultReadingReply(SetExamResultReadingReplyRequest $request)
    {
        $setExamResultReadingReplyResponse = $this->examSystemService->SetExamResultReadingReply(
            $request->answers
        );
        if ($setExamResultReadingReplyResponse->isSuccess()) {
            return $this->success(
                $setExamResultReadingReplyResponse->getMessage(),
                $setExamResultReadingReplyResponse->getData(),
                $setExamResultReadingReplyResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setExamResultReadingReplyResponse->getMessage(),
                $setExamResultReadingReplyResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetExamResultListRequest $request
     */
    public function getExamResultList(GetExamResultListRequest $request)
    {
        $getExamResultListResponse = $this->examSystemService->GetExamResultList(
            $request->examId
        );
        if ($getExamResultListResponse->isSuccess()) {
            return $this->success(
                $getExamResultListResponse->getMessage(),
                $getExamResultListResponse->getData(),
                $getExamResultListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getExamResultListResponse->getMessage(),
                $getExamResultListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetExamEditRequest $request
     */
    public function getExamEdit(GetExamEditRequest $request)
    {
        $getExamEditResponse = $this->examSystemService->GetExamEdit(
            $request->examId
        );
        if ($getExamEditResponse->isSuccess()) {
            return $this->success(
                $getExamEditResponse->getMessage(),
                $getExamEditResponse->getData(),
                $getExamEditResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getExamEditResponse->getMessage(),
                $getExamEditResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetQuestionsEditRequest $request
     */
    public function getQuestionsEdit(GetQuestionsEditRequest $request)
    {
        $getExamEditResponse = $this->examSystemService->GetQuestionsEdit(
            $request->questionId
        );
        if ($getExamEditResponse->isSuccess()) {
            return $this->success(
                $getExamEditResponse->getMessage(),
                $getExamEditResponse->getData(),
                $getExamEditResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getExamEditResponse->getMessage(),
                $getExamEditResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetQuestionOptionsEditRequest $request
     */
    public function getQuestionOptionsEdit(GetQuestionOptionsEditRequest $request)
    {
        $getExamEditResponse = $this->examSystemService->GetQuestionOptionsEdit(
            $request->questionOptionId
        );
        if ($getExamEditResponse->isSuccess()) {
            return $this->success(
                $getExamEditResponse->getMessage(),
                $getExamEditResponse->getData(),
                $getExamEditResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getExamEditResponse->getMessage(),
                $getExamEditResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetExamsRequest $request
     */
    public function setExams(SetExamsRequest $request)
    {
        $getExamResultListResponse = $this->examSystemService->SetExams(
            $request->name,
            $request->description,
            $request->duration,
            $request->date,
            $request->id
        );
        if ($getExamResultListResponse->isSuccess()) {
            return $this->success(
                $getExamResultListResponse->getMessage(),
                $getExamResultListResponse->getData(),
                $getExamResultListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getExamResultListResponse->getMessage(),
                $getExamResultListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetExamDeleteRequest $request
     */
    public function setExamDelete(SetExamDeleteRequest $request)
    {
        $setExamDeleteResponse = $this->examSystemService->SetExamDelete(
            $request->examId
        );
        if ($setExamDeleteResponse->isSuccess()) {
            return $this->success(
                $setExamDeleteResponse->getMessage(),
                $setExamDeleteResponse->getData(),
                $setExamDeleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setExamDeleteResponse->getMessage(),
                $setExamDeleteResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetQuestionsDeleteRequest $request
     */
    public function setQuestionsDelete(SetQuestionsDeleteRequest $request)
    {
        $response = $this->examSystemService->SetQuestionsDelete(
            $request->questionId
        );
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * @param SetQuestionOptionsDeleteRequest $request
     */
    public function setQuestionOptionsDelete(SetQuestionOptionsDeleteRequest $request)
    {
        $response = $this->examSystemService->SetQuestionOptionsDelete(
            $request->questionOptionId
        );
        if ($response->isSuccess()) {
            return $this->success(
                $response->getMessage(),
                $response->getData(),
                $response->getStatusCode()
            );
        } else {
            return $this->error(
                $response->getMessage(),
                $response->getStatusCode()
            );
        }
    }

    /**
     * @param GetQuestionsListRequest $request
     */
    public function getQuestionsList(GetQuestionsListRequest $request)
    {
        $getQuestionsListResponse = $this->examSystemService->GetQuestionsList(
            $request->examId
        );
        if ($getQuestionsListResponse->isSuccess()) {
            return $this->success(
                $getQuestionsListResponse->getMessage(),
                $getQuestionsListResponse->getData(),
                $getQuestionsListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getQuestionsListResponse->getMessage(),
                $getQuestionsListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetQuestionOptionsListRequest $request
     */
    public function getQuestionOptionsList(GetQuestionOptionsListRequest $request)
    {
        $getQuestionOptionsListResponse = $this->examSystemService->GetQuestionOptionsList(
            $request->questionId
        );
        if ($getQuestionOptionsListResponse->isSuccess()) {
            return $this->success(
                $getQuestionOptionsListResponse->getMessage(),
                $getQuestionOptionsListResponse->getData(),
                $getQuestionOptionsListResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getQuestionOptionsListResponse->getMessage(),
                $getQuestionOptionsListResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetQuestionsRequest $request
     */
    public function setQuestions(SetQuestionsRequest $request)
    {
        $setQuestionsResponse = $this->examSystemService->SetQuestions(
            $request->id ?? '',
            $request->examId,
            $request->question,
            $request->questionType,
            $request->order,
            $request->image
        );
        if ($setQuestionsResponse->isSuccess()) {
            return $this->success(
                $setQuestionsResponse->getMessage(),
                $setQuestionsResponse->getData(),
                $setQuestionsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setQuestionsResponse->getMessage(),
                $setQuestionsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetQuestionOptionsRequest $request
     */
    public function setQuestionOptions(SetQuestionOptionsRequest $request)
    {
        $setQuestionsResponse = $this->examSystemService->SetQuestionOptions(
            $request->id ?? '',
            $request->questionId,
            $request->answer,
            $request->order
        );
        if ($setQuestionsResponse->isSuccess()) {
            return $this->success(
                $setQuestionsResponse->getMessage(),
                $setQuestionsResponse->getData(),
                $setQuestionsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setQuestionsResponse->getMessage(),
                $setQuestionsResponse->getStatusCode()
            );
        }
    }
}
