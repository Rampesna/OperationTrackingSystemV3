<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IUserService;
use App\Models\Eloquent\User;
use Illuminate\Support\Facades\Crypt;

class UserService implements IUserService
{
    public function getAll()
    {
        return User::all();
    }

    /**
     * @param int $id
     */
    public function getById(
        int $id
    )
    {
        return User::find($id);
    }

    /**
     * @param string $email
     */
    public function getByEmail(
        string $email
    )
    {
        return User::where('email', $email)->first();
    }

    /**
     * @param int $userId
     * @param int $companyId
     */
    public function swapCompany(
        int $userId,
        int $companyId
    )
    {
        $user = $this->getById($userId);

        if (!$user) {
            return false;
        }

        $user->default_company_id = $companyId;
        $user->save();

        return $user;
    }

    /**
     * @param int $userId
     * @param int $theme
     */
    public function swapTheme(
        int $userId,
        int $theme
    )
    {
        $user = $this->getById($userId);

        if (!$user) {
            return false;
        }

        $user->theme = $theme;
        $user->save();

        return $user;
    }

    /**
     * @param int $userId
     */
    public function getCompanies(
        int $userId
    )
    {
        $user = $this->getById($userId);

        if (!$user) {
            return $this->error('User not found', 404);
        }

        return $user->companies;
    }

    /**
     * @param User $user
     */
    public function generateSanctumToken(
        User $user
    )
    {
        $token = $user->createToken('userApiToken')->plainTextToken;

        $user->api_token = $token;
        $user->save();

        return $token;
    }

    /**
     * @param User $user
     */
    public function generateOAuthToken(
        User $user
    )
    {
        return Crypt::encrypt($user->id);
    }

    public function create(
        int    $roleId,
        string $name,
        string $email,
        string $phoneNumber = null,
        string $identificationNumber = null,
        int    $defaultCompanyId = null,
        string $password
    )
    {
        $user = new User();
        $user->role_id = $roleId;
        $user->name = $name;
        $user->email = $email;
        $user->phone_number = $phoneNumber;
        $user->identification_number = $identificationNumber;
        $user->default_company_id = $defaultCompanyId;
        $user->password = $password;
        $user->save();

        return $user;
    }

    public function update()
    {

    }

    /**
     * @param int $id
     */
    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }
}
