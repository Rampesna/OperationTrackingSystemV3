<?php

namespace App\Http\Controllers\Api\User;

use App\Interfaces\IUserService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserController\LoginRequest;

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
}
