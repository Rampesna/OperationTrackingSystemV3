<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\CommercialCompanyController\GetAllRequest;
use App\Interfaces\Eloquent\ICommercialCompanyService;
use App\Traits\Response;

class CommercialCompanyController extends Controller
{
    use Response;

    /**
     * @var $commercialCompanyService
     */
    private $commercialCompanyService;

    /**
     * @param ICommercialCompanyService $commercialCompanyService
     */
    public function __construct(ICommercialCompanyService $commercialCompanyService)
    {
        $this->commercialCompanyService = $commercialCompanyService;
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->commercialCompanyService->getAll();
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
