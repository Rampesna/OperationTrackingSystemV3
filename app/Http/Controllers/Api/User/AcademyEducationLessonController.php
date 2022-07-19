<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\AcademyEducationLessonController\GetByAcademyEducationIdRequest;
use App\Http\Requests\Api\User\AcademyEducationLessonController\CreateRequest;
use App\Http\Requests\Api\User\AcademyEducationLessonController\UpdateByParametersRequest;
use App\Http\Requests\Api\User\AcademyEducationLessonController\DeleteRequest;
use App\Interfaces\Eloquent\IAcademyEducationLessonService;
use App\Traits\Response;

class AcademyEducationLessonController extends Controller
{
    use Response;

    /**
     * @var $academyEducationLessonService
     */
    private $academyEducationLessonService;

    /**
     * @param IAcademyEducationLessonService $academyEducationLessonService
     */
    public function __construct(IAcademyEducationLessonService $academyEducationLessonService)
    {
        $this->academyEducationLessonService = $academyEducationLessonService;
    }

    /**
     * @param GetByAcademyEducationIdRequest $request
     */
    public function getByAcademyEducationId(GetByAcademyEducationIdRequest $request)
    {
        $getByAcademyEducationIdResponse = $this->academyEducationLessonService->getByAcademyEducationId(
            $request->academyEducationId
        );
        if ($getByAcademyEducationIdResponse->isSuccess()) {
            return $this->success(
                $getByAcademyEducationIdResponse->getMessage(),
                $getByAcademyEducationIdResponse->getData(),
                $getByAcademyEducationIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByAcademyEducationIdResponse->getMessage(),
                $getByAcademyEducationIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->academyEducationLessonService->create(
            $request->academyEducationId,
            $request->name,
            $request->durationInMinutes
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
     * @param UpdateByParametersRequest $request
     */
    public function updateByParameters(UpdateByParametersRequest $request)
    {
        $updateResponse = $this->academyEducationLessonService->updateByParameters(
            $request->id,
            $request->parameters
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
        $deleteResponse = $this->academyEducationLessonService->delete(
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
