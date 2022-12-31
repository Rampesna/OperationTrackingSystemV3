<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IUserService;
use App\Mail\User\ForgotPasswordEmail;
use App\Mail\User\WelcomeEmail;
use App\Models\Eloquent\Project;
use App\Models\Eloquent\User;
use App\Services\ServiceResponse;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class UserService implements IUserService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All users',
            200,
            User::all()
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getById(
        int $id
    ): ServiceResponse
    {
        $user = User::with([
            'companies'
        ])->find($id);
        if ($user) {
            return new ServiceResponse(
                true,
                'User',
                200,
                $user
            );
        } else {
            return new ServiceResponse(
                false,
                'User not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     * @param int|null $typeId
     *
     * @return ServiceResponse
     */
    public function index(
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null,
        ?int    $typeId = null
    ): ServiceResponse
    {
        $users = User::with([
            'role',
            'type'
        ])->where(function ($users) use ($keyword) {
            $users->where('name', 'like', '%' . $keyword . '%')
                ->orWhere('email', 'like', '%' . $keyword . '%');
        });

        if ($typeId) {
            $users->where('type_id', $typeId);
        }

        return new ServiceResponse(
            true,
            'Users',
            200,
            [
                'totalCount' => $users->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'users' => $users->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $typeId
     *
     * @return ServiceResponse
     */
    public function getAllByTypeId(
        int $typeId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Users',
            200,
            User::where('type_id', $typeId)->get()
        );
    }

    /**
     * @param int|null $typeId
     * @param array|null $userIds
     * @param array|null $projectIds
     *
     * @return ServiceResponse
     */
    public function getAllWithTimesheets(
        ?int   $typeId = null,
        ?array $userIds = [],
        ?array $projectIds = []
    ): ServiceResponse
    {
        $taskIds = [];

        if ($projectIds && count($projectIds) > 0) {
            foreach ($projectIds as $projectId) {
                $project = Project::find($projectId);
                if ($project) {
                    $tasks = $project->tasks;
                    if ($tasks && count($tasks) > 0) {
                        foreach ($tasks as $task) {
                            $taskIds[] = $task->id;
                        }
                    }
                }
            }
        }

        $users = User::with([
            'timesheets' => function ($timesheets) use ($taskIds) {
                $timesheets->with([
                    'task' => function ($task) use ($taskIds) {
                        $task->with([
                            'board' => function ($project) {
                                $project->with([
                                    'project'
                                ]);
                            }
                        ]);
                    }
                ])->whereNull('end_time')->when($taskIds && count($taskIds) > 0, function ($timesheets) use ($taskIds) {
                    $timesheets->whereIn('task_id', $taskIds);
                });
            }
        ]);

        if ($userIds && count($userIds) > 0) {
            $users->whereIn('id', $userIds);
        }

        if ($typeId) {
            $users->where('type_id', $typeId);
        }

        return new ServiceResponse(
            true,
            'Users',
            200,
            $users->get()
        );
    }

    /**
     * @param string $email
     * @param int|null $exceptId
     *
     * @return ServiceResponse
     */
    public function getByEmail(
        string $email,
        ?int   $exceptId = null
    ): ServiceResponse
    {
        $user = User::where('email', $email);

        if ($exceptId) {
            $user->where('id', '!=', $exceptId);
        }

        $user = $user->first();

        if ($user) {
            return new ServiceResponse(
                true,
                'User',
                200,
                $user
            );
        } else {
            return new ServiceResponse(
                false,
                'User not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getProfile(
        int $id
    ): ServiceResponse
    {
        $user = User::find($id);
        if ($user) {
            return new ServiceResponse(
                true,
                'User',
                200,
                [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'phone' => $user->phone,
                    'identity' => $user->identity,
                    'image' => $user->image,
                    'theme' => $user->theme,
                    'device_token' => $user->device_token,
                ]
            );
        } else {
            return new ServiceResponse(
                false,
                'User not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $userId
     * @param int $theme
     *
     * @return ServiceResponse
     */
    public function swapTheme(
        int $userId,
        int $theme
    ): ServiceResponse
    {
        $user = $this->getById($userId);

        if ($user->isSuccess()) {
            $user->getData()->theme = $theme;
            $user->getData()->save();

            return new ServiceResponse(
                true,
                'User theme swapped',
                200,
                $user->getData()
            );
        } else {
            return $user;
        }
    }

    /**
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function getCompanies(
        int $userId
    ): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            return new ServiceResponse(
                true,
                'User companies',
                200,
                $user->getData()->companies
            );
        } else {
            return $user;
        }
    }

    /**
     * @param int $userId
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function setCompanies(
        int   $userId,
        array $companyIds
    ): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            $user->getData()->companies()->sync($companyIds);
            return new ServiceResponse(
                true,
                'User companies set',
                200,
                $user->getData()
            );
        } else {
            return $user;
        }
    }

    /**
     * @param int $userId
     * @param int $companyId
     *
     * @return ServiceResponse
     */
    public function setSingleCompany(
        int $userId,
        int $companyId
    ): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            $user->getData()->companies()->attach([$companyId]);
            return new ServiceResponse(
                true,
                'User company set',
                200,
                $user->getData()
            );
        } else {
            return $user;
        }
    }

    /**
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function getSelectedCompanies(
        int $userId
    ): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            return new ServiceResponse(
                true,
                'User selected companies',
                200,
                $user->getData()->selectedCompanies
            );
        } else {
            return $user;
        }
    }

    /**
     * @param int $userId
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function setSelectedCompanies(
        int   $userId,
        array $companyIds
    ): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            $user->getData()->selectedCompanies()->sync($companyIds);
            return new ServiceResponse(
                true,
                'User selected companies set',
                200,
                $user->getData()
            );
        } else {
            return $user;
        }
    }

    /**
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function getUserMeetings(
        int $userId
    ): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            return new ServiceResponse(
                true,
                'User meetings',
                200,
                $user->getData()->meetings
            );
        } else {
            return $user;
        }
    }

    /**
     * @param int $userId
     * @param array $meetingIds
     *
     * @return ServiceResponse
     */
    public function setUserMeetings(
        int   $userId,
        array $meetingIds
    ): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            $user->getData()->meetings()->sync($meetingIds);
            return new ServiceResponse(
                true,
                'User meetings set',
                200,
                $user->getData()
            );
        } else {
            return $user;
        }
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
     * @param int $typeId
     * @param string $name
     * @param string $email
     * @param string|null $phone
     * @param string|null $identity
     *
     * @return ServiceResponse
     */
    public function create(
        int     $roleId,
        int     $typeId,
        string  $name,
        string  $email,
        ?string $phone = null,
        ?string $identity = null
    ): ServiceResponse
    {
        $password = Str::random(8);

        $user = new User;
        $user->role_id = $roleId;
        $user->type_id = $typeId;
        $user->name = $name;
        $user->email = $email;
        $user->phone = $phone;
        $user->identity = $identity;
        $user->password = bcrypt($password);
        $user->save();

        Mail::to($email)->send(new WelcomeEmail($email, $password));

        return new ServiceResponse(
            true,
            'User created',
            201,
            $user
        );
    }

    /**
     * @param int $id
     * @param int $roleId
     * @param int $typeId
     * @param string $name
     * @param string $email
     * @param string|null $phone
     * @param string|null $identity
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        int     $roleId,
        int     $typeId,
        string  $name,
        string  $email,
        ?string $phone = null,
        ?string $identity = null
    ): ServiceResponse
    {
        $user = $this->getById($id);
        if ($user->isSuccess()) {
            $user->getData()->role_id = $roleId;
            $user->getData()->type_id = $typeId;
            $user->getData()->name = $name;
            $user->getData()->email = $email;
            $user->getData()->phone = $phone;
            $user->getData()->identity = $identity;
            $user->getData()->save();

            return new ServiceResponse(
                true,
                'User updated',
                200,
                $user->getData()
            );
        } else {
            return $user;
        }
    }

    /**
     * @param int $userId
     * @param int $suspend
     *
     * @return ServiceResponse
     */
    public function setSuspend(
        int $userId,
        int $suspend
    ): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            $user->getData()->suspend = $suspend;
            $user->getData()->save();

            return new ServiceResponse(
                true,
                'User suspended',
                200,
                $user->getData()
            );
        } else {
            return $user;
        }
    }

    /**
     * @param int $userId
     * @param string $password
     *
     * @return ServiceResponse
     */
    public function updatePassword(
        int    $userId,
        string $password
    ): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            $user->getData()->password = $password;
            $user->getData()->save();

            return new ServiceResponse(
                true,
                'User password updated',
                200,
                $user->getData()
            );
        } else {
            return $user;
        }
    }

    /**
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function getMeetings(
        int $userId,
    ): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            return new ServiceResponse(
                true,
                'User meetings',
                200,
                $user->getData()->meetings
            );
        } else {
            return $user;
        }
    }

    /**
     * @param int $userId
     *
     * @return ServiceResponse
     */
    public function getCentralMissions(
        int $userId,
    ): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            return new ServiceResponse(
                true,
                'User centralMissions',
                200,
                $user->getData()->centralMissions
            );
        } else {
            return $user;
        }
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function delete(
        int $id
    ): ServiceResponse
    {
        $user = $this->getById($id);
        if ($user->isSuccess()) {
            $user->getData()->delete();

            return new ServiceResponse(
                true,
                'User deleted',
                200,
                $user->getData()
            );
        } else {
            return $user;
        }
    }

    /**
     * @param int $userId
     * @param int $pageIndex
     * @param int $pageSize
     * @param int|null $isRead
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getNotifications(
        int     $userId,
        int     $pageIndex,
        int     $pageSize,
        ?int    $isRead = null,
        ?string $keyword = null
    ): ServiceResponse
    {
        $user = $this->getById($userId);
        if ($user->isSuccess()) {
            $notifications = $user->getData()->notifications();

            if ($isRead) {
                $notifications = $notifications->where('is_read', $isRead);
            }

            if ($keyword) {
                $notifications = $notifications->where(function ($notifications) use ($keyword) {
                    $notifications->where('heading', 'like', '%' . $keyword . '%')
                        ->orWhere('message', 'like', '%' . $keyword . '%');
                });
            }

            return new ServiceResponse(
                true,
                'User notifications',
                200,
                [
                    'totalCount' => $notifications->count(),
                    'pageIndex' => $pageIndex,
                    'pageSize' => $pageSize,
                    'notifications' => $pageSize == -1 ?
                        $notifications->get() :
                        $notifications->skip($pageSize * $pageIndex)->take($pageSize)->get()
                ]
            );
        } else {
            return $user;
        }
    }
}
