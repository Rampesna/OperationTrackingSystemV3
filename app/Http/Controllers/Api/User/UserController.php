<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserController\LoginRequest;
use App\Http\Requests\Api\User\UserController\GetCompaniesRequest;
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
}
