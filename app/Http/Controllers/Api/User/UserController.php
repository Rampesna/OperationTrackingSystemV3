<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserController\LoginRequest;
use App\Http\Requests\Api\User\UserController\SwapThemeRequest;
use App\Interfaces\Eloquent\IUserService;

class UserController extends Controller
{
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
        return $this->userService->login(
            $request->email,
            $request->password
        );
    }

    public function swapTheme(SwapThemeRequest $request)
    {
        return $this->userService->swapTheme(
            $request->user()->id,
            $request->theme
        );
    }
}
