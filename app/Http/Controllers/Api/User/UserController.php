<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserController\GetCompaniesRequest;
use App\Http\Requests\Api\User\UserController\SetCompaniesRequest;
use App\Http\Requests\Api\User\UserController\SetSingleCompanyRequest;
use App\Http\Requests\Api\User\UserController\GetSelectedCompaniesRequest;
use App\Http\Requests\Api\User\UserController\SetSelectedCompaniesRequest;
use App\Http\Requests\Api\User\UserController\LoginRequest;
use App\Http\Requests\Api\User\UserController\SwapCompanyRequest;
use App\Http\Requests\Api\User\UserController\SwapThemeRequest;
use App\Interfaces\Eloquent\IUserService;
use App\Traits\Response;

class UserController extends Controller
{
    use Response;

    private $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        if (!$user = $this->userService->getByEmail($request->email)) {
            return $this->error('User not found', 404);
        }

        if (!checkPassword($request->password, $user->password)) {
            return $this->error('Password is incorrect', 401);
        }

        return $this->success('User logged in successfully', [
            'token' => $this->userService->generateSanctumToken($user)
        ]);
    }

    public function swapCompany(SwapCompanyRequest $request)
    {
        $companies = $this->userService->getCompanies($request->user()->id);

        if (count($companies) == 0) {
            return $this->error('User has no companies', 404);
        }

        if (!in_array($request->companyId, $companies->pluck('id')->toArray())) {
            return $this->error('Company not found', 403);
        }

        return $this->success('Company swapped successfully', $this->userService->swapCompany(
            $request->user()->id,
            $request->companyId
        ));
    }

    public function swapTheme(SwapThemeRequest $request)
    {
        return $this->success('Theme swapped successfully', $this->userService->swapTheme(
            $request->user()->id,
            $request->theme
        ));
    }

    public function getCompanies(GetCompaniesRequest $request)
    {
        return $this->success('User companies', $this->userService->getCompanies(
            $request->user()->id
        ));
    }

    public function setCompanies(SetCompaniesRequest $request)
    {
        return $this->success('User companies', $this->userService->setCompanies(
            $request->user()->id,
            $request->companyIds
        ));
    }

    public function setSingleCompany(SetSingleCompanyRequest $request)
    {
        return $this->success('User companies', $this->userService->setSingleCompany(
            $request->user()->id,
            $request->companyId
        ));
    }

    public function getSelectedCompanies(GetSelectedCompaniesRequest $request)
    {
        return $this->success('User selected companies', $this->userService->getSelectedCompanies(
            $request->user()->id
        ));
    }

    public function setSelectedCompanies(SetSelectedCompaniesRequest $request)
    {
        $companies = $this->userService->getCompanies($request->user()->id);

        if (count($companies) == 0) {
            return $this->error('User has no companies', 404);
        }

        foreach ($request->companyIds as $companyId) {
            if (!in_array($companyId, $companies->pluck('id')->toArray())) {
                return $this->error('Company not found', 403);
            }
        }

        return $this->success('User selected companies', $this->userService->setSelectedCompanies(
            $request->user()->id,
            $request->companyIds
        ));
    }
}
