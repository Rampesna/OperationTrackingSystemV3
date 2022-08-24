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
use App\Http\Requests\Api\User\UserController\GetProfileRequest;
use App\Http\Requests\Api\User\UserController\SwapThemeRequest;
use App\Http\Requests\Api\User\UserController\UpdatePasswordRequest;
use App\Http\Requests\Api\User\UserController\GetAllRequest;
use App\Http\Requests\Api\User\UserController\GetByIdRequest;
use App\Http\Requests\Api\User\UserController\GetByEmailRequest;
use App\Http\Requests\Api\User\UserController\CreateRequest;
use App\Http\Requests\Api\User\UserController\UpdateRequest;
use App\Http\Requests\Api\User\UserController\SetSuspendRequest;
use App\Http\Requests\Api\User\UserController\DeleteRequest;
use App\Interfaces\Eloquent\IPasswordResetService;
use App\Interfaces\Eloquent\IUserService;
use App\Mail\User\ForgotPasswordEmail;
use App\Models\Eloquent\User;
use App\Traits\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserController extends Controller
{
    use Response;

    /**
     * @var $userService
     */
    private $userService;

    /**
     * @var $passwordResetService
     */
    public function __construct(IUserService $userService)
    {
        $this->userService = $userService;
    }

    /**
     * @param LoginRequest $request
     */
    public function login(LoginRequest $request)
    {
        $user = $this->userService->getByEmail($request->email);
        if ($user->isSuccess()) {
            if (!checkPassword($request->password, $user->getData()->password)) {
                return $this->error('Password is incorrect', 401);
            }

            if ($user->getData()->suspend == 1) {
                return $this->error('User is suspended', 403);
            }

            return $this->success('User logged in successfully', [
                'token' => $this->userService->generateSanctumToken($user->getData())
            ]);
        } else {
            return $this->error(
                $user->getMessage(),
                $user->getStatusCode()
            );
        }
    }

    public function login2(Request $request)
    {
        if (!$request->email) {
            return response()->json([
                'message' => 'E-posta Göndermediniz'
            ], 422);
        }

        if (!$request->password) {
            return response()->json([
                'message' => 'Şifrenizi Göndermediniz'
            ], 422);
        }

        $user = User::where('email', $request->email)->first();

        if ($user) {
            if (Hash::check($request->password, $user->password)) {
                $token = Str::random(8);
                return response()->json([
                    'message' => 'Başarıyla Giriş Yaptınız',
                    'token' => $token
                ], 400);
            } else {
                return response()->json([
                    'message' => 'Girdiğiniz Şifre Hatalı'
                ], 400);
            }
        } else {
            return response()->json([
                'message' => 'Bu E-posta Adresi Sistemde Kayıtlı Değil'
            ], 400);
        }
    }

    /*
     *
     * Single Responsibility
     * Open / Closed
     * L
     * Interface Segration
     * Dependency Injection
     *
     * */

    /**
     * @param GetProfileRequest $request
     */
    public function getProfile(GetProfileRequest $request)
    {
        $getProfileResponse = $this->userService->getProfile(
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
        $swapThemeResponse = $this->userService->swapTheme(
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
     * @param UpdatePasswordRequest $request
     */
    public function updatePassword(UpdatePasswordRequest $request)
    {
        $user = $this->userService->getById($request->user()->id);
        if ($user->isSuccess()) {
            if (Hash::check($request->oldPassword, $user->getData()->password)) {
                $user->getData()->password = bcrypt($request->newPassword);
                $user->getData()->save();

                return $this->success(
                    'Password updated successfully',
                    $user->getData(),
                    $user->getStatusCode()
                );
            } else {
                return $this->error(
                    'Old password is incorrect',
                    401
                );
            }
        } else {
            return $this->error(
                $user->getMessage(),
                $user->getStatusCode()
            );
        }
    }

    /**
     * @param GetCompaniesRequest $request
     */
    public function getCompanies(GetCompaniesRequest $request)
    {
        $getCompaniesResponse = $this->userService->getCompanies(
            $request->user()->id
        );
        if ($getCompaniesResponse->isSuccess()) {
            return $this->success(
                $getCompaniesResponse->getMessage(),
                $getCompaniesResponse->getData(),
                $getCompaniesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getCompaniesResponse->getMessage(),
                $getCompaniesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetCompaniesRequest $request
     */
    public function setCompanies(SetCompaniesRequest $request)
    {
        $setCompaniesResponse = $this->userService->setCompanies(
            $request->user()->id,
            $request->companyIds
        );
        if ($setCompaniesResponse->isSuccess()) {
            return $this->success(
                $setCompaniesResponse->getMessage(),
                $setCompaniesResponse->getData(),
                $setCompaniesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setCompaniesResponse->getMessage(),
                $setCompaniesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetUserCompaniesRequest $request
     */
    public function setUserCompanies(SetUserCompaniesRequest $request)
    {
        $setUserCompaniesResponse = $this->userService->setCompanies(
            $request->userId,
            $request->companyIds
        );
        if ($setUserCompaniesResponse->isSuccess()) {
            return $this->success(
                $setUserCompaniesResponse->getMessage(),
                $setUserCompaniesResponse->getData(),
                $setUserCompaniesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setUserCompaniesResponse->getMessage(),
                $setUserCompaniesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSingleCompanyRequest $request
     */
    public function setSingleCompany(SetSingleCompanyRequest $request)
    {
        $setSingleCompanyResponse = $this->userService->setSingleCompany(
            $request->user()->id,
            $request->companyId
        );
        if ($setSingleCompanyResponse->isSuccess()) {
            return $this->success(
                $setSingleCompanyResponse->getMessage(),
                $setSingleCompanyResponse->getData(),
                $setSingleCompanyResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSingleCompanyResponse->getMessage(),
                $setSingleCompanyResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetSelectedCompaniesRequest $request
     */
    public function getSelectedCompanies(GetSelectedCompaniesRequest $request)
    {
        $getSelectedCompaniesResponse = $this->userService->getSelectedCompanies(
            $request->user()->id
        );
        if ($getSelectedCompaniesResponse->isSuccess()) {
            return $this->success(
                $getSelectedCompaniesResponse->getMessage(),
                $getSelectedCompaniesResponse->getData(),
                $getSelectedCompaniesResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getSelectedCompaniesResponse->getMessage(),
                $getSelectedCompaniesResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSelectedCompaniesRequest $request
     */
    public function setSelectedCompanies(SetSelectedCompaniesRequest $request)
    {
        $companies = $this->userService->getCompanies($request->user()->id);

        if ($companies->isSuccess()) {
            if (count($companies->getData()) == 0) {
                return $this->error('User has no companies', 404);
            }

            foreach ($request->companyIds as $companyId) {
                if (!in_array($companyId, $companies->getData()->pluck('id')->toArray())) {
                    return $this->error('Company not found', 403);
                }
            }

            $setSelectedCompaniesResponse = $this->userService->setSelectedCompanies(
                $request->user()->id,
                $request->companyIds
            );

            if ($setSelectedCompaniesResponse->isSuccess()) {
                return $this->success(
                    $setSelectedCompaniesResponse->getMessage(),
                    $setSelectedCompaniesResponse->getData(),
                    $setSelectedCompaniesResponse->getStatusCode()
                );
            } else {
                return $this->error(
                    $setSelectedCompaniesResponse->getMessage(),
                    $setSelectedCompaniesResponse->getStatusCode()
                );
            }
        } else {
            return $this->error(
                $companies->getMessage(),
                $companies->getStatusCode()
            );
        }
    }

    /**
     * @param GetAllRequest $request
     */
    public function getAll(GetAllRequest $request)
    {
        $getAllResponse = $this->userService->getAll();
        if ($getAllResponse->isSuccess()) {
            return $this->success(
                $getAllResponse->getMessage(),
                $getAllResponse->getData(),
                $getAllResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getAllResponse->getMessage(),
                $getAllResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByIdRequest $request
     */
    public function getById(GetByIdRequest $request)
    {
        $getByIdResponse = $this->userService->getById(
            $request->id
        );
        if ($getByIdResponse->isSuccess()) {
            return $this->success(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getData(),
                $getByIdResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByIdResponse->getMessage(),
                $getByIdResponse->getStatusCode()
            );
        }
    }

    /**
     * @param GetByEmailRequest $request
     */
    public function getByEmail(GetByEmailRequest $request)
    {
        $getByEmailResponse = $this->userService->getByEmail(
            $request->email,
            $request->exceptId
        );
        if ($getByEmailResponse->isSuccess()) {
            return $this->success(
                $getByEmailResponse->getMessage(),
                $getByEmailResponse->getData(),
                $getByEmailResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $getByEmailResponse->getMessage(),
                $getByEmailResponse->getStatusCode()
            );
        }
    }

    /**
     * @param CreateRequest $request
     */
    public function create(CreateRequest $request)
    {
        $createResponse = $this->userService->create(
            $request->roleId,
            $request->name,
            $request->email,
            $request->phone,
            $request->identity
        );
        if ($createResponse->isSuccess()) {
            return $this->success(
                $createResponse->getMessage(),
                $createResponse->getData(),
                $createResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $createResponse->getMessage(),
                $createResponse->getStatusCode()
            );
        }
    }

    /**
     * @param UpdateRequest $request
     */
    public function update(UpdateRequest $request)
    {
        $updateResponse = $this->userService->update(
            $request->id,
            $request->roleId,
            $request->name,
            $request->email,
            $request->phone,
            $request->identity
        );
        if ($updateResponse->isSuccess()) {
            return $this->success(
                $updateResponse->getMessage(),
                $updateResponse->getData(),
                $updateResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $updateResponse->getMessage(),
                $updateResponse->getStatusCode()
            );
        }
    }

    /**
     * @param SetSuspendRequest $request
     */
    public function setSuspend(SetSuspendRequest $request)
    {
        $setSuspendResponse = $this->userService->setSuspend(
            $request->userId,
            $request->suspend
        );
        if ($setSuspendResponse->isSuccess()) {
            return $this->success(
                $setSuspendResponse->getMessage(),
                $setSuspendResponse->getData(),
                $setSuspendResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $setSuspendResponse->getMessage(),
                $setSuspendResponse->getStatusCode()
            );
        }
    }

    /**
     * @param DeleteRequest $request
     */
    public function delete(DeleteRequest $request)
    {
        $deleteResponse = $this->userService->delete(
            $request->id
        );
        if ($deleteResponse->isSuccess()) {
            return $this->success(
                $deleteResponse->getMessage(),
                $deleteResponse->getData(),
                $deleteResponse->getStatusCode()
            );
        } else {
            return $this->error(
                $deleteResponse->getMessage(),
                $deleteResponse->getStatusCode()
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
        $user = $this->userService->getByEmail($request->email);
        if ($user->isSuccess()) {
            $checkPasswordReset = $passwordResetService->checkPasswordReset(
                'App\\Models\\Eloquent\\User',
                $user->getData()->id,
                date('Y-m-d H:i:s', strtotime('-1 hour'))
            );

            if ($checkPasswordReset->isSuccess()) {
                return $this->error('You can not send another password reset email for the same user within an hour', 406);
            }

            $passwordReset = $passwordResetService->create(
                'App\\Models\\Eloquent\\User',
                $user->getData()->id
            );

            Mail::to($user->getData()->email)->send(new ForgotPasswordEmail($passwordReset->getData()->token));

            return $this->success('Password reset email sent successfully', null);
        } else {
            return $this->error(
                $user->getMessage(),
                $user->getStatusCode()
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
            $user = $this->userService->getById($passwordReset->getData()->relation_id);
            if ($user->isSuccess()) {
                $passwordResetService->setUsed(
                    $passwordReset->getData()->id
                );
                $this->userService->updatePassword(
                    $user->getData()->id,
                    bcrypt($request->newPassword)
                );

                return $this->success('Password reset successfully', null);
            } else {
                return $this->error(
                    $user->getMessage(),
                    $user->getStatusCode()
                );
            }
        } else {
            return $this->error(
                $passwordReset->getMessage(),
                $passwordReset->getStatusCode()
            );
        }
    }
}
