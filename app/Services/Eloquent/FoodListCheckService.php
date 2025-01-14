<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IFoodListCheckService;
use App\Interfaces\Eloquent\IFoodListService;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\FoodList;
use App\Models\Eloquent\FoodListCheck;
use App\Services\ServiceResponse;

class FoodListCheckService implements IFoodListCheckService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All food list checks',
            200,
            FoodListCheck::all()
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
        $foodListCheck = FoodListCheck::with([
            'foodList',
        ])->find($id);
        if ($foodListCheck) {
            return new ServiceResponse(
                true,
                'Food list check',
                200,
                $foodListCheck
            );
        } else {
            return new ServiceResponse(
                false,
                'Food list check not found',
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
        $foodListCheck = FoodListCheck::find($id);
        if ($foodListCheck) {
            $foodListCheck->delete();
            return new ServiceResponse(
                true,
                'Food list check deleted',
                200,
                $foodListCheck
            );
        } else {
            return $foodListCheck;
        }
    }

    /**
     * @param int $employeeId
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetween(
        int    $employeeId,
        array  $companyIds,
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Food list checks',
            200,
            FoodListCheck::with([
                'foodList'
            ])->where('employee_id', $employeeId)
                ->whereIn(
                    'food_list_id',
                    FoodList::whereIn('company_id', $companyIds)->whereBetween('date', [$startDate, $endDate])->get()->pluck('id')->toArray()
                )->get()
        );
    }

    /**
     * @param int $foodListId
     * @param int $companyId
     *
     * @return ServiceResponse
     */
    public function createBatch(
        int $foodListId,
        int $companyId
    ): ServiceResponse
    {
        $foodListChecksForInsert = [];
        $employees = Employee::where('company_id', $companyId)->where('leave', 0)->get();
        foreach ($employees as $employee) {
            $foodListChecksForInsert[] = [
                'food_list_id' => $foodListId,
                'employee_id' => $employee->id,
                'count' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        return new ServiceResponse(
            true,
            'Food list checks created',
            200,
            FoodListCheck::insert($foodListChecksForInsert)
        );
    }

    /**
     * @param int $id
     * @param int|null $checked
     * @param int|null $liked
     * @param int $count
     * @param string|null $description
     *
     * @return ServiceResponse
     */
    public function update(
        int         $id,
        int|null    $checked,
        int|null    $liked,
        int         $count,
        string|null $description
    ): ServiceResponse
    {
        $foodListCheck = $this->getById($id);
        if ($foodListCheck->isSuccess()) {
            $foodListCheck->getData()->checked = $checked;
            $foodListCheck->getData()->liked = $liked;
            $foodListCheck->getData()->count = $count;
            $foodListCheck->getData()->description = $description;
            $foodListCheck->getData()->save();
            return new ServiceResponse(
                true,
                'Food list check updated',
                200,
                $foodListCheck->getData()
            );
        } else {
            return $foodListCheck;
        }
    }
}
