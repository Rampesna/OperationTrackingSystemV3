<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ICareerService;
use App\Models\Eloquent\Career;
use App\Services\ServiceResponse;
use Illuminate\Support\Str;

class CareerService implements ICareerService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All careers',
            200,
            Career::all()
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
        $career = Career::find($id);
        if ($career) {
            return new ServiceResponse(
                true,
                'Career',
                200,
                $career
            );
        } else {
            return new ServiceResponse(
                false,
                'Career not found',
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
    public function delete(
        int $id
    ): ServiceResponse
    {
        $career = $this->getById($id);
        if ($career->isSuccess()) {
            return new ServiceResponse(
                true,
                'Career deleted',
                200,
                $career->getData()->delete()
            );
        } else {
            return $career;
        }
    }

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     */
    public function index(
        int     $pageIndex = 0,
        int     $pageSize = 10,
        ?string $keyword = null
    ): ServiceResponse
    {
        $careers = Career::orderBy('id', 'desc');

        if ($keyword) {
            $careers->where(function ($careers) use ($keyword) {
                $careers->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('identity', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                    ->orWhere('phone', 'like', '%' . $keyword . '%')
                    ->orWhere('department', 'like', '%' . $keyword . '%');
            });
        }

        return new ServiceResponse(
            true,
            'Careers',
            200,
            [
                'totalCount' => $careers->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'careers' => $careers->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param string $name
     * @param string $identity
     * @param string $email
     * @param string $phone
     * @param string $department
     * @param mixed $cv
     */
    public function create(
        string $name,
        string $identity,
        string $email,
        string $phone,
        string $department,
        mixed  $cv
    ): ServiceResponse
    {
        $career = new Career();
        $career->name = $name;
        $career->identity = $identity;
        $career->email = $email;
        $career->phone = $phone;
        $career->department = $department;
        $career->cv = $cv;
        $career->number = Str::random(8);
        $career->save();
        return new ServiceResponse(
            true,
            'Career created',
            201,
            $career
        );
    }
}
