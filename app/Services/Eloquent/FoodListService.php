<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IFoodListCheckService;
use App\Interfaces\Eloquent\IFoodListService;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\FoodList;
use App\Models\Eloquent\FoodListCheck;
use App\Services\ServiceResponse;
use Carbon\CarbonPeriod;

class FoodListService implements IFoodListService
{
    /**
     * @var $foodListCheckService
     */
    private $foodListCheckService;

    /**
     * @param IFoodListCheckService $foodListCheckService
     */
    public function __construct(IFoodListCheckService $foodListCheckService)
    {
        $this->foodListCheckService = $foodListCheckService;
    }

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
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetween(
        array  $companyIds,
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Food lists between dates',
            200,
            FoodList::whereIn('company_id', $companyIds)->whereBetween('date', [$startDate, $endDate])->get()
        );
    }

    /**
     * @param int $companyId
     * @param string $date
     *
     * @return ServiceResponse
     */
    public function getByCompanyIdAndDate(
        int    $companyId,
        string $date
    ): ServiceResponse
    {
        $foodList = FoodList::where('company_id', $companyId)->where('date', $date)->first();
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
     * @param int $companyId
     * @param string $name
     * @param string|null $description
     * @param string $date
     * @param int|null $count
     */
    public function create(
        int     $companyId,
        string  $name,
        ?string $description,
        string  $date,
        ?int    $count
    ): ServiceResponse
    {
        $foodList = $this->getByCompanyIdAndDate($companyId, $date);
        if ($foodList->isSuccess()) {
            return new ServiceResponse(
                false,
                'Food list already exists',
                406,
                null
            );
        } else {
            $foodList = new FoodList;
            $foodList->company_id = $companyId;
            $foodList->name = $name;
            $foodList->description = $description;
            $foodList->date = $date;
            $foodList->count = $count;
            $foodList->save();

            $this->foodListCheckService->createBatch(
                $foodList->id,
                $companyId
            );

            return new ServiceResponse(
                true,
                'Food list created',
                201,
                $foodList
            );
        }
    }

    /**
     * @param int $id
     * @param string $name
     * @param string|null $description
     */
    public function update(
        int     $id,
        string  $name,
        ?string $description,
    ): ServiceResponse
    {
        $foodList = $this->getById($id);
        if ($foodList->isSuccess()) {
            $foodList->getData()->name = $name;
            $foodList->getData()->description = $description;
            $foodList->getData()->save();
            return new ServiceResponse(
                true,
                'Food list updated',
                200,
                $foodList->getData()
            );
        } else {
            return $foodList;
        }
    }

    /**
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function report(
        array  $companyIds,
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        $report = [];
        $datesArray = [];
        $dates = CarbonPeriod::create($startDate, $endDate);
        foreach ($dates as $date) {
            $datesArray[] = $date->format('Y-m-d');
        }

        $employees = Employee::whereIn('company_id', $companyIds)->where('leave', 0)->get();

        foreach ($employees as $employee) {
            $foodListChecks = FoodListCheck::with([
                'foodList'
            ])->whereIn(
                'food_list_id',
                FoodList::whereIn('company_id', $companyIds)->whereBetween('date', [
                    $startDate,
                    $endDate
                ])->pluck('id')->toArray()
            )->where('employee_id', $employee->id)->get();

            $dateReports = [];

            foreach ($foodListChecks as $foodListCheck) {
                $dateReports[$foodListCheck->foodList->date] = $foodListCheck->checked === 1 ? $foodListCheck->count : 0;
            }

            $report[] = array_merge(
                [
                    'employee' => $employee->name
                ],
                $dateReports
            );
        }

        return new ServiceResponse(
            true,
            'Food list report',
            200,
            [
                'report' => $report,
                'dates' => $datesArray
            ]
        );
    }
}
