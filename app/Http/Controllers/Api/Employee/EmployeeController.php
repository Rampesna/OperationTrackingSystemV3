<?php

namespace App\Http\Controllers\Api\Employee;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Employee\EmployeeController\LoginRequest;
use App\Http\Requests\Api\Employee\EmployeeController\RegisterRequest;
use App\Http\Requests\Api\Employee\EmployeeController\GetProfileRequest;
use App\Http\Requests\Api\Employee\EmployeeController\ResetPasswordRequest;
use App\Http\Requests\Api\Employee\EmployeeController\SendPasswordResetEmailRequest;
use App\Http\Requests\Api\Employee\EmployeeController\SwapThemeRequest;
use App\Http\Requests\Api\Employee\EmployeeController\GetMarketPaymentsRequest;
use App\Http\Requests\Api\Employee\EmployeeController\GetPositionsRequest;
use App\Http\Requests\Api\Employee\EmployeeController\SetDeviceTokenRequest;
use App\Http\Requests\Api\Employee\EmployeeController\UpdatePasswordRequest;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\Eloquent\IPasswordResetService;
use App\Mail\Employee\ForgotPasswordEmail;
use App\Traits\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class EmployeeController extends Controller
{
    use Response;

    /**
     * @var $employeeService
     */
    private $employeeService;

    /**
     * @param IEmployeeService $employeeService
     */
    public function __construct(IEmployeeService $employeeService)
    {
        $this->employeeService = $employeeService;
    }

    /**
     * @param LoginRequest $request
     */
    public function login(
        LoginRequest $request
    )
    {
        $employee = $this->employeeService->getByEmail($request->email);
        if ($employee->isSuccess()) {
            if (!checkPassword($request->password, $employee->getData()->password)) {
                return $this->error('Password is incorrect', 401);
            }

            return $this->success('Employee logged in successfully', [
                'token' => $this->employeeService->generateSanctumToken($employee->getData())
            ]);
        } else {
            return $this->error(
                $employee->getMessage(),
                $employee->getStatusCode()
            );
        }
    }

    /**
     * @param SendPasswordResetEmailRequest $request
     * @param IPasswordResetService $request
     */
    public function sendPasswordResetEmail(
        SendPasswordResetEmailRequest $request,
        IPasswordResetService         $passwordResetService
    )
    {
        $employee = $this->employeeService->getByEmail($request->email);
        if ($employee->isSuccess()) {
            $checkPasswordReset = $passwordResetService->checkPasswordReset(
                'App\\Models\\Eloquent\\Employee',
                $employee->getData()->id,
                date('Y-m-d H:i:s', strtotime('-1 hour'))
            );

            if ($checkPasswordReset->isSuccess()) {
                return $this->error('You can not send another password reset email for the same employee within an hour', 406);
            }

            $passwordReset = $passwordResetService->create(
                'App\\Models\\Eloquent\\Employee',
                $employee->getData()->id
            );

            Mail::to($employee->getData()->email)->send(new ForgotPasswordEmail($passwordReset->getData()->token));

            return $this->success('Password reset email sent successfully', []);
        } else {
            return $this->error(
                $employee->getMessage(),
                $employee->getStatusCode()
            );
        }
    }

    /**
     * @param ResetPasswordRequest $request
     * @param IPasswordResetService $request
     */
    public function resetPassword(
        ResetPasswordRequest  $request,
        IPasswordResetService $passwordResetService
    )
    {
        $passwordReset = $passwordResetService->getByToken($request->resetPasswordToken);
        if ($passwordReset->isSuccess()) {
            $employee = $this->employeeService->getById($passwordReset->getData()->relation_id);
            if ($employee->isSuccess()) {
                $passwordResetService->setUsed(
                    $passwordReset->getData()->id
                );
                $this->employeeService->updatePassword(
                    $employee->getData()->id,
                    bcrypt($request->newPassword)
                );

                return $this->success('Password reset successfully', []);
            } else {
                return $this->error(
                    $employee->getMessage(),
                    $employee->getStatusCode()
                );
            }
        } else {
            return $this->error(
                $passwordReset->getMessage(),
                $passwordReset->getStatusCode()
            );
        }
    }

    /**
     * @param RegisterRequest $request
     */
    public function register(RegisterRequest $request)
    {
        $registerResponse = $this->employeeService->register(
            $request->name,
            $request->email,
            $request->password
        );
        if ($registerResponse->isSuccess()) {
            return $this->success(
                $registerResponse->getMessage(),
                $registerResponse->getData(),
                $registerResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $registerResponse->getMessage(),
                $registerResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetProfileRequest $request
     */
    public function getProfile(GetProfileRequest $request)
    {
        $getProfileResponse = $this->employeeService->getProfile(
            $request->user()->id
        );
        if ($getProfileResponse->isSuccess()) {
            return $this->success(
                $getProfileResponse->getMessage(),
                $getProfileResponse->getData(),
                $getProfileResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getProfileResponse->getMessage(),
                $getProfileResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SwapThemeRequest $request
     */
    public function swapTheme(SwapThemeRequest $request)
    {
        $swapThemeResponse = $this->employeeService->swapTheme(
            $request->user()->id,
            $request->theme
        );
        if ($swapThemeResponse->isSuccess()) {
            return $this->success(
                $swapThemeResponse->getMessage(),
                $swapThemeResponse->getData(),
                $swapThemeResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $swapThemeResponse->getMessage(),
                $swapThemeResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetDeviceTokenRequest $request
     */
    public function setDeviceToken(SetDeviceTokenRequest $request)
    {
        $setDeviceTokenResponse = $this->employeeService->setDeviceToken(
            $request->user()->id,
            $request->deviceToken
        );
        if ($setDeviceTokenResponse->isSuccess()) {
            return $this->success(
                $setDeviceTokenResponse->getMessage(),
                $setDeviceTokenResponse->getData(),
                $setDeviceTokenResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setDeviceTokenResponse->getMessage(),
                $setDeviceTokenResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetMarketPaymentsRequest $request
     */
    public function getMarketPayments(GetMarketPaymentsRequest $request)
    {
        $employeeMarketPayments = $this->employeeService->getMarketPayments(
            $request->user()->id
        );
        if ($employeeMarketPayments->isSuccess()) {
            return $this->success(
                $employeeMarketPayments->getMessage(),
                $employeeMarketPayments->getData(),
                $employeeMarketPayments->getStatusCode()
            );
        } else {
            return $this->error(
                $employeeMarketPayments->getMessage(),
                $employeeMarketPayments->getStatusCode()
            );
        }
    }

    /**
     * @param GetPositionsRequest $request
     */
    public function getPositions(GetPositionsRequest $request)
    {
        $getPositionsResponse = $this->employeeService->getPositions(
            $request->user()->id
        );
        if ($getPositionsResponse->isSuccess()) {
            return $this->success(
                $getPositionsResponse->getMessage(),
                $getPositionsResponse->getData(),
                $getPositionsResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getPositionsResponse->getMessage(),
                $getPositionsResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdatePasswordRequest $request
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $employee = $this->employeeService->getById($request->user()->id);
        if ($employee->isSuccess()) {
            if (Hash::check($request->oldPassword, $employee->getData()->password)) {
                $employee->getData()->password = bcrypt($request->newPassword);
                $employee->getData()->save();

                return $this->success(
                    'Password updated successfully',
                    $employee->getData(),
                    $employee->getStatusCode()
                );
            } else {
                return $this->error(
                    'Old password is incorrect',
                    401
                );
            }
        } else {
            return $this->error(
                $employee->getMessage(),
                $employee->getStatusCode()
            );
        }
    }
}
