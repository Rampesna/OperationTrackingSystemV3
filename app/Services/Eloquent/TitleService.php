<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ITitleService;
use App\Models\Eloquent\Title;
use App\Services\ServiceResponse;

class TitleService implements ITitleService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All titles',
            200,
            Title::all()
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
        $title = Title::find($id);
        if ($title) {
            return new ServiceResponse(
                true,
                'Title',
                200,
                $title
            );
        } else {
            return new ServiceResponse(
                false,
                'Title not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $departmentId
     *
     * @return ServiceResponse
     */
    public function getByDepartmentId(
        int $departmentId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Titles',
            200,
            Title::where('department_id', $departmentId)->get()
        );
    }

    /**
     * @param int $departmentId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        int    $departmentId,
        string $name
    ): ServiceResponse
    {
        $title = new Title;
        $title->department_id = $departmentId;
        $title->name = $name;
        $title->save();

        return new ServiceResponse(
            true,
            'Title created',
            201,
            $title
        );
    }

    /**
     * @param int $id
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $name
    ): ServiceResponse
    {
        $title = $this->getById($id);
        if ($title->isSuccess()) {
            $title->getData()->name = $name;
            $title->getData()->save();

            return new ServiceResponse(
                true,
                'Title updated',
                200,
                $title->getData()
            );
        } else {
            return $title;
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
        $title = $this->getById($id);
        if ($title->isSuccess()) {
            return new ServiceResponse(
                true,
                'Title deleted',
                200,
                $title->getData()->delete()
            );
        } else {
            return $title;
        }
    }

}
