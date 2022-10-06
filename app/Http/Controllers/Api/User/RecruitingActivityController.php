<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\IRecruitingActivityService;
use App\Http\Requests\Api\User\RecruitingActivityController\GetByRecruitingIdRequest;
use App\Http\Requests\Api\User\RecruitingActivityController\CreateRequest;
use App\Traits\Response;

class RecruitingActivityController extends Controller
{
    use Response;

    /**
     * @var $recruitingActivityService
     */
    private $recruitingActivityService;

    /**
     * @param IRecruitingActivityService $recruitingActivityService
     */
    public function __construct(IRecruitingActivityService $recruitingActivityService)
    {
        $this->recruitingActivityService = $recruitingActivityService;
    }

    /**
     * @param GetByRecruitingIdRequest $request
     */
    public function getByRecruitingId(GetByRecruitingIdRequest $request)
    {
        $getByRecruitingIdResponse = $this->recruitingActivityService->getByRecruitingId(
            $request->recruitingId
        );
        if ($getByRecruitingIdResponse->isSuccess()) {
            return $this->success(
                $getByRecruitingIdResponse->getMessage(),
                $getByRecruitingIdResponse->getData(),
                $getByRecruitingIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByRecruitingIdResponse->getMessage(),
                $getByRecruitingIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->recruitingActivityService->create(
            $request->recruitingId,
            $request->transaction,
            $request->user()->id,
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
}
