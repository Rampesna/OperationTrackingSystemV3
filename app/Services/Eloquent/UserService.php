<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IUserService;
use App\Models\Eloquent\User;
use App\Traits\Response;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Hash;

class UserService implements IUserService
{
    use Response;

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
     * @param string $email
     * @param string $password
     */
    public function login(
        string $email,
        string $password
    )
    {
        if (!$user = $this->getByEmail($email)) {
            return $this->error('User not found', 404);
        }

        if (!Hash::check($password, $user->password)) {
            return $this->error('Password is incorrect', 401);
        }

        return $this->success('User logged in successfully', [
            'token' => $this->generateSanctumToken($user)
        ]);
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
            return $this->error('User not found', 404);
        }

        $user->theme = $theme;
        $user->save();

        return $this->success('Theme changed successfully', null);
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
