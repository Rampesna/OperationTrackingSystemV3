<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IShiftGroupEmployeeUseListService;
use App\Interfaces\Eloquent\IShiftGroupService;
use App\Models\Eloquent\ShiftGroupEmployeeUseList;
use App\Services\ServiceResponse;

class ShiftGroupEmployeeUseListService implements IShiftGroupEmployeeUseListService
{
    private $shiftGroupService;

    /**
     * @param IShiftGroupService $shiftGroupService
     */
    public function __construct(IShiftGroupService $shiftGroupService)
    {
        $this->shiftGroupService = $shiftGroupService;
    }

    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All shift group employee use lists',
            200,
            ShiftGroupEmployeeUseList::all()
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
        $shiftGroupEmployeeUseList = ShiftGroupEmployeeUseList::find($id);
        if ($shiftGroupEmployeeUseList) {
            return new ServiceResponse(
                true,
                'Shift group employee use list',
                200,
                $shiftGroupEmployeeUseList
            );
        } else {
            return new ServiceResponse(
                false,
                'Shift group employee use list not found',
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
        $shiftGroupEmployeeUseList = $this->getById($id);
        if ($shiftGroupEmployeeUseList->isSuccess()) {
            return new ServiceResponse(
                true,
                'Shift group employee use list deleted',
                200,
                $shiftGroupEmployeeUseList->getData()->delete()
            );
        } else {
            return $shiftGroupEmployeeUseList;
        }
    }

    /**
     * @param int $shiftGroupId
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function create(
        int $shiftGroupId,
        int $employeeId
    ): ServiceResponse
    {
        $shiftGroupEmployeeUseList = new ShiftGroupEmployeeUseList;
        $shiftGroupEmployeeUseList->shift_group_id = $shiftGroupId;
        $shiftGroupEmployeeUseList->employee_id = $employeeId;
        $shiftGroupEmployeeUseList->save();

        return new ServiceResponse(
            true,
            'Shift group employee use list created',
            201,
            $shiftGroupEmployeeUseList
        );
    }

    /**
     * @param int $shiftGroupId
     *
     * @return ServiceResponse
     */
    public function setShiftGroupEmployeesNotUsed(
        int $shiftGroupId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Shift group employee use lists set to not used',
            200,
            ShiftGroupEmployeeUseList::where('shift_group_id', $shiftGroupId)->update([
                'used' => 0,
            ])
        );
    }

    /**
     * @param int $shiftGroupId
     *
     * @return ServiceResponse
     */
    public function getUsableShiftGroupEmployees(
        int $shiftGroupId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Usable shift group employee use lists',
            200,
            ShiftGroupEmployeeUseList::where('shift_group_id', $shiftGroupId)->where('used', 0)->get()
        );
    }

    /**
     * @param int $shiftGroupId
     *
     * @return ServiceResponse
     */
    public function getUsedShiftGroupEmployees(
        int $shiftGroupId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Used shift group employee use lists',
            200,
            ShiftGroupEmployeeUseList::where('shift_group_id', $shiftGroupId)->where('used', 1)->get()
        );
    }

    /**
     * @param int $shiftGroupId
     * @param int $employeeId
     *
     * @return ServiceResponse
     */
    public function setUsedShiftGroupEmployee(
        int $shiftGroupId,
        int $employeeId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Shift group employee use list set to used',
            200,
            ShiftGroupEmployeeUseList::where('shift_group_id', $shiftGroupId)->where('employee_id', $employeeId)->update([
                'used' => 1,
            ])
        );
    }

    /**
     * @return ServiceResponse
     */
    public function initialize(): ServiceResponse
    {
        $shiftGroups = $this->shiftGroupService->getAll();
        if ($shiftGroups->isSuccess()) {
            foreach ($shiftGroups->getData() as $shiftGroup) {
                foreach ($shiftGroup->employees ?? [] as $employee) {
                    $shiftGroupEmployee = ShiftGroupEmployeeUseList::where('shift_group_id', $shiftGroup->id)->where('employee_id', $employee->id)->first();
                    if (!$shiftGroupEmployee) {
                        $this->create($shiftGroup->id, $employee->id);
                    }
                }
            }
        }

        return new ServiceResponse(
            true,
            'Shift group employee use lists initialize completed',
            200,
            null
        );
    }
}
