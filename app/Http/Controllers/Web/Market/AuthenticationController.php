<?php

namespace App\Http\Controllers\Web\Market;

use App\Http\Controllers\Controller;
use App\Http\Requests\Web\User\AuthenticationController\OAuthRequest;
use App\Interfaces\Eloquent\IPasswordResetService;
use App\Interfaces\Eloquent\IPersonalAccessTokenService;
use Illuminate\Http\Request;

class AuthenticationController extends Controller
{
    private $personelAccessTokenService;

    public function __construct(IPersonalAccessTokenService $personalAccessTokenService)
    {
        $this->personelAccessTokenService = $personalAccessTokenService;
    }

    public function login()
    {
        if (auth()->guard('market_web')->check()) {
            return redirect()->route('market.web.dashboard.index');
        }

        return view('market.modules.authentication.login.index');
    }

    public function oAuth(OAuthRequest $request)
    {
        if (!$token = $this->personelAccessTokenService->findToken($request->token)) {
            return redirect()->route('market.web.authentication.login.index');
        }

        if (!$market = $token->tokenable) {
            return redirect()->route('market.web.authentication.login.index');
        }

        auth()->guard('market_web')->login($market, $request->remember);

        return redirect()->route('market.web.dashboard.index');
    }

    public function forgotPassword()
    {
        return view('market.modules.authentication.forgotPassword.index');
    }

    public function resetPassword(Request $request, IPasswordResetService $passwordResetService)
    {
        if (!$request->token) {
            abort(404);
        }

        $passwordReset = $passwordResetService->getByToken($request->token);

        if (!$passwordReset || $passwordReset->used == 1) {
            abort(404);
        }

        return view('market.modules.authentication.resetPassword.index', [
            'token' => $request->token
        ]);
    }

    public function logout()
    {
        auth()->guard('market_web')->logout();
        return redirect()->route('market.web.authentication.login.index');
    }
}
