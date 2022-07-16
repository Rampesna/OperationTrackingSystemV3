<?php

namespace App\Http\Controllers\Web\Employee;

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
        if (auth()->guard('employee_web')->check()) {
            return redirect()->route('employee.web.dashboard.index');
        }

        return view('employee.modules.authentication.login.index');
    }

    public function oAuth(OAuthRequest $request)
    {
        $token = $this->personelAccessTokenService->findToken($request->token);
        if ($token->isSuccess()) {
            if (!$employee = $token->getData()->tokenable) {
                return redirect()->route('employee.web.authentication.login.index');
            }

            auth()->guard('employee_web')->login($employee, $request->remember);

            return redirect()->route('employee.web.dashboard.index');
        } else {
            return redirect()->route('employee.web.authentication.login.index');
        }
    }

    public function forgotPassword()
    {
        return view('employee.modules.authentication.forgotPassword.index');
    }

    public function resetPassword(Request $request, IPasswordResetService $passwordResetService)
    {
        if (!$request->token) {
            abort(404);
        }

        $passwordReset = $passwordResetService->getByToken($request->token);

        if (!$passwordReset->getData() || $passwordReset->getData()->used == 1) {
            abort(404);
        }

        return view('employee.modules.authentication.resetPassword.index', [
            'token' => $request->token
        ]);
    }

    public function logout()
    {
        auth()->guard('employee_web')->logout();
        return redirect()->route('employee.web.authentication.login.index');
    }
}
