<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\User\UserController\GetCompaniesRequest;
use App\Http\Requests\Api\User\UserController\ResetPasswordRequest;
use App\Http\Requests\Api\User\UserController\SendPasswordResetEmailRequest;
use App\Http\Requests\Api\User\UserController\SetCompaniesRequest;
use App\Http\Requests\Api\User\UserController\SetUserCompaniesRequest;
use App\Http\Requests\Api\User\UserController\SetSingleCompanyRequest;
use App\Http\Requests\Api\User\UserController\GetSelectedCompaniesRequest;
use App\Http\Requests\Api\User\UserController\SetSelectedCompaniesRequest;
use App\Http\Requests\Api\User\UserController\LoginRequest;
use App\Http\Requests\Api\User\UserController\SwapThemeRequest;
use App\Http\Requests\Api\User\UserController\GetByIdRequest;
use App\Http\Requests\Api\User\UserController\GetByEmailRequest;
use App\Http\Requests\Api\User\UserController\CreateRequest;
use App\Http\Requests\Api\User\UserController\UpdateRequest;
use App\Http\Requests\Api\User\UserController\SetSuspendRequest;
use App\Http\Requests\Api\User\UserController\DeleteRequest;
use App\Interfaces\Eloquent\IPasswordResetService;
use App\Interfaces\Eloquent\IUserService;
use App\Mail\User\ForgotPasswordEmail;
use App\Traits\Response;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    use Response;

    private $userService;

    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    public function login(LoginRequest $request)
    {
        if (!$user = $this->userService->getByEmail($request->email)) {
            return $this->error('User not found', 404);
        }

        if (!checkPassword($request->password, $user->password)) {
            return $this->error('Password is incorrect', 401);
        }

        if ($user->suspend == 1) {
            return $this->error('User is suspended', 403);
        }

        return $this->success('User logged in successfully', [
            'token' => $this->userService->generateSanctumToken($user)
        ]);
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

    public function setUserCompanies(SetUserCompaniesRequest $request)
    {
        return $this->success('User companies', $this->userService->setCompanies(
            $request->userId,
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

    public function getById(GetByIdRequest $request)
    {
        return $this->success('Users', $this->userService->getById(
            $request->id
        ));
    }

    public function getByEmail(GetByEmailRequest $request)
    {
        return $this->success('User', $this->userService->getByEmail(
            $request->email,
            $request->exceptId
        ));
    }

    public function create(CreateRequest $request)
    {
        return $this->success('User created', $this->userService->create(
            $request->roleId,
            $request->name,
            $request->email,
            $request->phone,
            $request->identity
        ));
    }

    public function update(UpdateRequest $request)
    {
        return $this->success('User updated', $this->userService->update(
            $request->id,
            $request->roleId,
            $request->name,
            $request->email,
            $request->phone,
            $request->identity
        ));
    }

    public function setSuspend(SetSuspendRequest $request)
    {
        return $this->success('Set user suspend', $this->userService->setSuspend(
            $request->userId,
            $request->suspend
        ));
    }

    public function delete(DeleteRequest $request)
    {
        return $this->success('User deleted', $this->userService->delete(
            $request->id
        ));
    }

    public function sendPasswordResetEmail(SendPasswordResetEmailRequest $request, IPasswordResetService $passwordResetService)
    {
        $user = $this->userService->getByEmail($request->email);

        if (!$user) {
            return $this->error('User not found', 404);
        }

        $checkPasswordReset = $passwordResetService->checkPasswordReset(
            'App\\Models\\Eloquent\\User',
            $user->id,
            date('Y-m-d H:i:s', strtotime('-1 hour'))
        );

        if ($checkPasswordReset == true) {
            return $this->error('You can not send another password reset email for the same user within an hour', 406);
        }

        $passwordReset = $passwordResetService->create(
            'App\\Models\\Eloquent\\User',
            $user->id
        );

        Mail::to($user->email)->send(new ForgotPasswordEmail($passwordReset->token));

        return $this->success('Password reset email sent successfully', null);
    }

    public function resetPassword(ResetPasswordRequest $request, IPasswordResetService $passwordResetService)
    {
        if (!$passwordReset = $passwordResetService->getByToken($request->resetPasswordToken)) return $this->error('Password reset token not found', 404);
        if (!$user = $this->userService->getById($passwordReset->relation_id)) return $this->error('User not found', 404);

        $passwordResetService->setUsed(
            $passwordReset->id
        );
        $this->userService->updatePassword(
            $user->id,
            bcrypt($request->newPassword)
        );

        return $this->success('Password reset successfully', null);
    }
}
