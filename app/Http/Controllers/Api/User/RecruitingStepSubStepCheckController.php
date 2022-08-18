<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\RecruitingStepSubStepCheckController\UpdateCheckRequest;
use App\Interfaces\Eloquent\IRecruitingStepSubStepCheckService;
use App\Traits\Response;

class RecruitingStepSubStepCheckController extends Controller
{
    use Response;

    /**
     * @var $recruitingStepSubStepCheckService
     */
    private $recruitingStepSubStepCheckService;

    /**
     * @param IRecruitingStepSubStepCheckService $recruitingStepSubStepCheckService
     */
    public function __construct(IRecruitingStepSubStepCheckService $recruitingStepSubStepCheckService)
    {
        $this->recruitingStepSubStepCheckService = $recruitingStepSubStepCheckService;
    }

    /**
     * @param UpdateCheckRequest $request
     */
    public function updateCheck(UpdateCheckRequest $request)
    {
        $updateCheckResponse = $this->recruitingStepSubStepCheckService->updateCheck(
            $request->id
        );
        if ($updateCheckResponse->isSuccess()) {
            return $this->success(
                $updateCheckResponse->getMessage(),
                $updateCheckResponse->getData(),
                $updateCheckResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateCheckResponse->getMessage(),
                $updateCheckResponse->getStatusCode()
            );
        }
    }
}
