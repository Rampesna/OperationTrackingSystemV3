<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\PermitTypeController\GetAllRequest;
use App\Interfaces\Eloquent\IPermitTypeService;
use App\Traits\Response;

class PermitTypeController extends Controller
{
    use Response;

    /**
     * @var $permitTypeService
     */
    private $permitTypeService;

    /**
     * @param IPermitTypeService $permitTypeService
     */
    public function __construct(IPermitTypeService $permitTypeService)
    {
        $this->permitTypeService = $permitTypeService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->permitTypeService->getAll();
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
