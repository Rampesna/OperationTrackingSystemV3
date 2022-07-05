<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IFoodListCheckService;
use App\Interfaces\Eloquent\IFoodListService;
use App\Models\Eloquent\FoodListCheck;

class FoodListCheckService implements IFoodListCheckService
{
    private $foodListService;

    public function __construct(IFoodListService $foodListService)
    {
        $this->foodListService = $foodListService;
    }

    public function getAll()
    {
        return FoodListCheck::all();
    }

    public function getById(
        int $id
    )
    {
        return FoodListCheck::with([
            'foodList',
        ])->find($id);
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }

    public function getDateBetween(
        int    $employeeId,
        string $startDate,
        string $endDate
    )
    {
        return FoodListCheck::with([
            'foodList'
        ])->where('employee_id', $employeeId)
            ->whereIn(
                'food_list_id',
                $this->foodListService->getDateBetween(
                    $startDate,
                    $endDate
                )->pluck('id')->toArray()
            )->get();
    }

    public function update(
        int      $id,
        int|null $checked,
        int|null $liked,
        int      $count,
        string|null   $description
    )
    {
        $foodListCheck = $this->getById($id);
        $foodListCheck->checked = $checked;
        $foodListCheck->liked = $liked;
        $foodListCheck->count = $count;
        $foodListCheck->description = $description;
        $foodListCheck->save();

        return $foodListCheck;
    }
}
