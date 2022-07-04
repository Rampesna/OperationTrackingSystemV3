<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IFoodListService;
use App\Models\Eloquent\FoodList;

class FoodListService implements IFoodListService
{
    public function getAll()
    {
        return FoodList::all();
    }

    public function getById(
        int $id
    )
    {
        return FoodList::find($id);
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }

    public function getDateBetween(
        string $startDate,
        string $endDate
    )
    {
        return FoodList::whereBetween('date', [$startDate, $endDate])->get();
    }
}
