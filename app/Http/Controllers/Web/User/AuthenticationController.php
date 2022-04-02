<?php

namespace App\Http\Controllers\Web\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;

class AuthenticationController extends Controller
{
    public function login()
    {
        if (auth()->guard('user_web')->check()) {
            return redirect()->route('user.web.dashboard.index');
        }

        return view('user.modules.authentication.login.index');
    }

    public function oAuth(Request $request)
    {
        if (!$token = PersonalAccessToken::findToken($request->token)) {
            return redirect()->route('user.web.authentication.login.index');
        }

        if (!$user = $token->tokenable) {
            return redirect()->route('user.web.authentication.login.index');
        }

        auth()->guard('user_web')->login($user);

        return redirect()->route('user.web.dashboard.index');
    }

    public function logout()
    {
        auth()->guard('user_web')->logout();
        return redirect()->route('user.web.authentication.login.index');
    }
}
