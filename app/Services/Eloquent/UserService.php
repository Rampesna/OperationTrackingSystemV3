<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IUserService;
use App\Mail\User\ForgotPasswordEmail;
use App\Mail\User\WelcomeEmail;
use App\Models\Eloquent\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

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
        return User::with([
            'companies'
        ])->find($id);
    }

    /**
     * @param string $email
     * @param int|null $exceptId
     */
    public function getByEmail(
        string $email,
        ?int   $exceptId = null
    )
    {
        $user = User::where('email', $email);

        if ($exceptId) {
            $user->where('id', '!=', $exceptId);
        }

        return $user->first();
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

        return $user ? $user->companies : [];
    }

    /**
     * @param int $userId
     * @param array $companyIds
     */
    public function setCompanies(
        int   $userId,
        array $companyIds
    )
    {
        $user = $this->getById($userId);
        $user->companies()->sync($companyIds);
    }

    /**
     * @param int $userId
     * @param int $companyId
     */
    public function setSingleCompany(
        int $userId,
        int $companyId
    )
    {
        $user = $this->getById($userId);
        $user->companies()->attach([$companyId]);
    }

    /**
     * @param int $userId
     */
    public function getSelectedCompanies(
        int $userId
    )
    {
        $user = $this->getById($userId);

        return $user ? $user->selectedCompanies : [];
    }

    /**
     * @param int $userId
     * @param array $companyIds
     */
    public function setSelectedCompanies(
        int   $userId,
        array $companyIds
    )
    {
        $user = $this->getById($userId);
        $user->selectedCompanies()->sync($companyIds);
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
     * @param int $roleId
     * @param string $name
     * @param string $email
     * @param string|null $phone
     * @param string|null $identity
     */
    public function create(
        int     $roleId,
        string  $name,
        string  $email,
        ?string $phone = null,
        ?string $identity = null
    )
    {
        $password = Str::random(8);

        $user = new User;
        $user->role_id = $roleId;
        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone;
        $user->identity = $identity;
        $user->password = bcrypt($password);
        $user->save();

        Mail::to($email)->send(new WelcomeEmail($email, $password));

        return $user;
    }

    /**
     * @param int $id
     * @param int $roleId
     * @param string $name
     * @param string $email
     * @param string|null $phone
     * @param string|null $identity
     */
    public function update(
        int     $id,
        int     $roleId,
        string  $name,
        string  $email,
        ?string $phone = null,
        ?string $identity = null
    )
    {
        $user = $this->getById($id);
        $user->role_id = $roleId;
        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone;
        $user->identity = $identity;
        $user->save();

        return $user;
    }

    /**
     * @param int $userId
     * @param int $suspend
     */
    public function setSuspend(
        int $userId,
        int $suspend
    )
    {
        $user = $this->getById($userId);
        $user->suspend = $suspend;
        $user->save();

        return $user;
    }

    /**
     * @param int $userId
     * @param string $password
     */
    public function updatePassword(
        int    $userId,
        string $password
    )
    {
        $user = $this->getById($userId);
        $user->password = $password;
        $user->save();

        return $user;
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
