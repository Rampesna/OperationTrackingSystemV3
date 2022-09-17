<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserTypeController\GetAllRequest;
use App\Interfaces\Eloquent\IUserTypeService;
use App\Traits\Response;

class UserTypeController extends Controller
{
    use Response;

    /**
     * @var $userTypeService
     */
    private $userTypeService;

    /**
     * @param IUserTypeService $userTypeService
     */
    public function __construct(IUserTypeService $userTypeService)
    {
        $this->userTypeService = $userTypeService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->userTypeService->getAll();
        if ($getAllResponse->isSuccess()) {
            return $this->success(
                $getAllResponse->getMessage(),
                $getAllResponse->getData(),
                $getAllResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllResponse->getMessage(),
                $getAllResponse->getStatusCode()
            );
        }
    }
}
