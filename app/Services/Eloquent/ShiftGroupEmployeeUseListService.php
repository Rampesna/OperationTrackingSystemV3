<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IShiftGroupEmployeeUseListService;
use App\Interfaces\Eloquent\IShiftGroupService;
use App\Models\Eloquent\ShiftGroupEmployeeUseList;

class ShiftGroupEmployeeUseListService implements IShiftGroupEmployeeUseListService
{
    private $shiftGroupService;

    public function __construct(IShiftGroupService $shiftGroupService)
    {
        $this->shiftGroupService = $shiftGroupService;
    }

    public function getAll()
    {
        return ShiftGroupEmployeeUseList::all();
    }

    public function getById(
        int $id
    )
    {
        return ShiftGroupEmployeeUseList::find($id);
    }

    public function delete(
        int $id
    )
    {
        return $this->getById($id)->delete();
    }

    public function create(
        int $shiftGroupId,
        int $employeeId
    )
    {
        $shiftGroupEmployeeUseList = new ShiftGroupEmployeeUseList;
        $shiftGroupEmployeeUseList->shift_group_id = $shiftGroupId;
        $shiftGroupEmployeeUseList->employee_id = $employeeId;
        $shiftGroupEmployeeUseList->save();

        return $shiftGroupEmployeeUseList;
    }

    /**
     * @param int $shiftGroupId
     */
    public function setShiftGroupEmployeesNotUsed(
        int $shiftGroupId
    )
    {
        return ShiftGroupEmployeeUseList::where('shift_group_id', $shiftGroupId)->update([
            'used' => 0,
        ]);
    }

    /**
     * @param int $shiftGroupId
     */
    public function getUsableShiftGroupEmployees(
        int $shiftGroupId
    )
    {
        return ShiftGroupEmployeeUseList::where('shift_group_id', $shiftGroupId)->where('used', 0)->get();
    }

    /**
     * @param int $shiftGroupId
     */
    public function getUsedShiftGroupEmployees(
        int $shiftGroupId
    )
    {
        return ShiftGroupEmployeeUseList::where('shift_group_id', $shiftGroupId)->where('used', 1)->get();
    }

    /**
     * @param int $shiftGroupId
     * @param int $employeeId
     */
    public function setUsedShiftGroupEmployee(
        int $shiftGroupId,
        int $employeeId
    )
    {
        return ShiftGroupEmployeeUseList::where('shift_group_id', $shiftGroupId)->where('employee_id', $employeeId)->update([
            'used' => 1,
        ]);
    }

    public function initialize()
    {
        $shiftGroups = $this->shiftGroupService->getAll();
        foreach ($shiftGroups as $shiftGroup) {
            foreach ($shiftGroup->employees ?? [] as $employee) {
                $shiftGroupEmployee = ShiftGroupEmployeeUseList::where('shift_group_id', $shiftGroup->id)->where('employee_id', $employee->id)->first();
                if (!$shiftGroupEmployee) {
                    $this->create($shiftGroup->id, $employee->id);
                }
            }
        }
    }
}
