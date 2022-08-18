<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPunishmentService;
use App\Models\Eloquent\Punishment;
use App\Services\ServiceResponse;

class PunishmentService implements IPunishmentService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All punishments',
            200,
            Punishment::all()
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
        $punishment = Punishment::find($id);
        if ($punishment) {
            return new ServiceResponse(
                true,
                'Punishment',
                200,
                $punishment
            );
        } else {
            return new ServiceResponse(
                false,
                'Punishment not found',
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
        $punishment = $this->getById($id);
        if ($punishment->isSuccess()) {
            return new ServiceResponse(
                true,
                'Punishment deleted',
                200,
                $punishment->getData()->delete()
            );
        } else {
            return $punishment;
        }
    }

    /**
     * @param int $employeeId
     * @param int $pageIndex
     * @param int $pageSize
     *
     * @return ServiceResponse
     */
    public function getByEmployeeId(
        int $employeeId,
        int $pageIndex,
        int $pageSize
    ): ServiceResponse
    {
        $punishments = Punishment::with([
            'category'
        ])->where('employee_id', $employeeId);

        return new ServiceResponse(
            true,
            'Punishments',
            200,
            [
                'totalCount' => $punishments->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'punishments' => $punishments->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $employeeId
     * @param int $categoryId
     * @param string $date
     * @param string|null $description
     * @param float|null $moneyDeduction
     *
     * @return ServiceResponse
     */
    public function create(
        int     $employeeId,
        int     $categoryId,
        string  $date,
        ?string $description,
        ?float  $moneyDeduction
    ): ServiceResponse
    {
        $punishment = new Punishment();
        $punishment->employee_id = $employeeId;
        $punishment->category_id = $categoryId;
        $punishment->date = $date;
        $punishment->description = $description;
        $punishment->money_deduction = $moneyDeduction;
        $punishment->save();
        return new ServiceResponse(
            true,
            'Punishment created',
            201,
            $punishment
        );
    }

    /**
     * @param int $id
     * @param int $employeeId
     * @param int $categoryId
     * @param string $date
     * @param string|null $description
     * @param float|null $moneyDeduction
     *
     * @return ServiceResponse
     */
    public function update(
        int     $id,
        int     $categoryId,
        string  $date,
        ?string $description,
        ?float  $moneyDeduction
    ): ServiceResponse
    {
        $punishment = $this->getById($id);
        if ($punishment->isSuccess()) {
            $punishment->getData()->category_id = $categoryId;
            $punishment->getData()->date = $date;
            $punishment->getData()->description = $description;
            $punishment->getData()->money_deduction = $moneyDeduction;
            $punishment->getData()->save();
            return new ServiceResponse(
                true,
                'Punishment updated',
                200,
                $punishment->getData()
            );
        } else {
            return $punishment;
        }
    }

    /**
     * @param int $id
     * @param int|string $file
     *
     * @return ServiceResponse
     */
    public function updateFile(
        int        $id,
        int|string $file
    ): ServiceResponse
    {
        $punishment = $this->getById($id);
        if ($punishment->isSuccess()) {
            $punishment->getData()->file = $file;
            $punishment->getData()->save();
            return new ServiceResponse(
                true,
                'Punishment updated',
                200,
                $punishment->getData()
            );
        } else {
            return $punishment;
        }
    }
}
