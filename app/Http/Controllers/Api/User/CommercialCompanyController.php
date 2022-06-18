<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Interfaces\Eloquent\ICommercialCompanyService;
use App\Traits\Response;

class CommercialCompanyController extends Controller
{
    use Response;

    private $commercialCompanyService;

    public function __construct(ICommercialCompanyService $commercialCompanyService)
    {
        $this->commercialCompanyService = $commercialCompanyService;
    }

    public function getAll()
    {
        return $this->success('Commercial companies', $this->commercialCompanyService->getAll());
    }
}
