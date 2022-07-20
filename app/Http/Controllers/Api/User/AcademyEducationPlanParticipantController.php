<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\AcademyEducationPlanParticipantController\GetByAcademyEducationPlanIdRequest;
use App\Http\Requests\Api\User\AcademyEducationPlanParticipantController\SyncAcademyEducationPlanParticipantsRequest;
use App\Http\Requests\Api\User\AcademyEducationPlanParticipantController\SetAttendanceRequest;
use App\Interfaces\Eloquent\IAcademyEducationPlanParticipantService;
use App\Traits\Response;

class AcademyEducationPlanParticipantController extends Controller
{
    use Response;

    /**
     * @var $academyEducationPlanParticipantService
     */
    private $academyEducationPlanParticipantService;

    /**
     * @param IAcademyEducationPlanParticipantService $academyEducationPlanParticipantService
     */
    public function __construct(IAcademyEducationPlanParticipantService $academyEducationPlanParticipantService)
    {
        $this->academyEducationPlanParticipantService = $academyEducationPlanParticipantService;
    }

    /**
     * @param GetByAcademyEducationPlanIdRequest $request
     */
    public function getByAcademyEducationPlanId(GetByAcademyEducationPlanIdRequest $request)
    {
        $getByAcademyEducationPlanIdResponse = $this->academyEducationPlanParticipantService->getByAcademyEducationPlanId(
            $request->academyEducationPlanId
        );
        if ($getByAcademyEducationPlanIdResponse->isSuccess()) {
            return $this->success(
                $getByAcademyEducationPlanIdResponse->getMessage(),
                $getByAcademyEducationPlanIdResponse->getData(),
                $getByAcademyEducationPlanIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByAcademyEducationPlanIdResponse->getMessage(),
                $getByAcademyEducationPlanIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SyncAcademyEducationPlanParticipantsRequest $request
     */
    public function syncAcademyEducationPlanParticipants(SyncAcademyEducationPlanParticipantsRequest $request)
    {
        $syncAcademyEducationPlanParticipantsResponse = $this->academyEducationPlanParticipantService->syncAcademyEducationPlanParticipants(
            $request->academyEducationPlanId,
            $request->employeeIds ?? []
        );
        if ($syncAcademyEducationPlanParticipantsResponse->isSuccess()) {
            return $this->success(
                $syncAcademyEducationPlanParticipantsResponse->getMessage(),
                $syncAcademyEducationPlanParticipantsResponse->getData(),
                $syncAcademyEducationPlanParticipantsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $syncAcademyEducationPlanParticipantsResponse->getMessage(),
                $syncAcademyEducationPlanParticipantsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetAttendanceRequest $request
     */
    public function setAttendance(SetAttendanceRequest $request)
    {
        $setAttendanceResponse = $this->academyEducationPlanParticipantService->setAttendance(
            $request->id,
            $request->attendance
        );
        if ($setAttendanceResponse->isSuccess()) {
            return $this->success(
                $setAttendanceResponse->getMessage(),
                $setAttendanceResponse->getData(),
                $setAttendanceResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setAttendanceResponse->getMessage(),
                $setAttendanceResponse->getStatusCode()
            );
        }
    }
}
