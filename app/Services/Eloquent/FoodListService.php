<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IFoodListService;
use App\Models\Eloquent\FoodList;
use App\Services\ServiceResponse;

class FoodListService implements IFoodListService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All food lists',
            200,
            FoodList::all()
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
        $foodList = FoodList::find($id);
        if ($foodList) {
            return new ServiceResponse(
                true,
                'Food list',
                200,
                $foodList
            );
        } else {
            return new ServiceResponse(
                false,
                'Food list not found',
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
        $foodList = $this->getById($id);
        if ($foodList->isSuccess()) {
            return new ServiceResponse(
                true,
                'Food list deleted',
                200,
                $foodList->getData()->delete()
            );
        } else {
            return $foodList;
        }
    }

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetween(
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Food lists between dates',
            200,
            FoodList::whereBetween('date', [$startDate, $endDate])->get()
        );
    }
}
