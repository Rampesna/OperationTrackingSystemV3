<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\User\AuthenticationController\OAuthRequest;
use App\Interfaces\Eloquent\IPersonalAccessTokenService;

class AuthenticationController extends Controller
{
    private $personelAccessTokenService;

    public function __construct(IPersonalAccessTokenService $personalAccessTokenService)
    {
        $this->personelAccessTokenService = $personalAccessTokenService;
    }

    public function login()
    {
        if (auth()->guard('user_web')->check()) {
            return redirect()->route('user.web.dashboard.index');
        }

        return view('user.modules.authentication.login.index');
    }

    public function oAuth(OAuthRequest $request)
    {
        if (!$token = $this->personelAccessTokenService->findToken($request->token)) {
            return redirect()->route('user.web.authentication.login.index');
        }

        if (!$user = $token->tokenable) {
            return redirect()->route('user.web.authentication.login.index');
        }

        auth()->guard('user_web')->login($user, $request->remember);

        return redirect()->route('user.web.dashboard.index');
    }

    public function logout()
    {
        auth()->guard('user_web')->logout();
        return redirect()->route('user.web.authentication.login.index');
    }
}
