<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ICompanyService;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\Eloquent\ISaturdayPermitService;
use App\Interfaces\Eloquent\IShiftGroupService;
use App\Interfaces\Eloquent\IShiftService;
use App\Interfaces\OperationApi\IOperationService;
use App\Interfaces\OperationApi\IPersonSystemService;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\SaturdayPermit;
use App\Models\Eloquent\Shift;
use App\Models\Eloquent\ShiftGroup;
use App\Services\ServiceResponse;

class SaturdayPermitService implements ISaturdayPermitService
{
    /**
     * @var $companyService
     */
    private $companyService;

    /**
     * @var $employeeService
     */
    private $employeeService;

    /**
     * @param ICompanyService $companyService
     * @param IEmployeeService $employeeService
     */
    public function __construct(
        ICompanyService  $companyService,
        IEmployeeService $employeeService,
    )
    {
        $this->companyService = $companyService;
        $this->employeeService = $employeeService;
    }

    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All saturday permits',
            200,
            SaturdayPermit::all()
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
        $saturdayPermit = SaturdayPermit::find($id);
        if ($saturdayPermit) {
            return new ServiceResponse(
                true,
                'Saturday permit',
                200,
                $saturdayPermit
            );
        } else {
            return new ServiceResponse(
                false,
                'Saturday permit not found',
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
        $saturdayPermit = $this->getById($id);
        if ($saturdayPermit->isSuccess()) {
            return new ServiceResponse(
                true,
                'Saturday permit deleted',
                200,
                $saturdayPermit->getData()->delete()
            );
        } else {
            return $saturdayPermit;
        }
    }

    /**
     * @param string $month
     * @param int $companyId
     *
     * @return ServiceResponse
     */
    public function robot(
        string $month,
        int    $companyId,
    ): ServiceResponse
    {
        $startDayOfMonth = 1;
        $endDayOfMonth = date('t', strtotime($month));
        for ($day = $startDayOfMonth; $day <= $endDayOfMonth; $day++) {
            $date = $month . '-' . sprintf('%02d', $day);
            if (intval(date('w', strtotime($date))) == 6) {
                $company = $this->companyService->getById($companyId)->getData();
                $employees = $this->employeeService->getByCompanyIds(
                    0,
                    10000,
                    [$companyId]
                )->getData()['employees'];
                foreach ($employees as $employee) {
                    if ($employee->saturday_permit_exemption != 1) {
                        $saturdayPermit = SaturdayPermit::where('employee_id', $employee->id)->where('date', $date)->first();
                        if (!$saturdayPermit) {
                            $saturdayPermit = new SaturdayPermit();
                            $saturdayPermit->employee_id = $employee->id;
                            $saturdayPermit->date = $date;
                            $saturdayPermit->status = $company->saturday_permit_reverse == $employee->saturday_permit_order ? 'on' : 'off';
                            $saturdayPermit->save();
                        }
                    }
                }
                $company->saturday_permit_reverse = $company->saturday_permit_reverse == 1 ? 0 : 1;
                $company->save();
            }
        }

        return new ServiceResponse(
            true,
            'Saturday permit robot completed successfully',
            200,
            null
        );
    }

    /**
     * @param string $date
     */
    public function getByDate(
        string $date,
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Saturday permit',
            200,
            SaturdayPermit::where('date', $date)->get()
        );
    }

    /**
     * @param array $companyIds
     * @param string $startDate
     * @param string $endDate
     * @param string|null $keyword
     * @param array|null $jobDepartmentIds
     */
    public function getDateBetween(
        array   $companyIds,
        string  $startDate,
        string  $endDate,
        ?string $keyword = null,
        ?array  $jobDepartmentIds = [],
    ): ServiceResponse
    {
        $employees = $this->employeeService->getByCompanyIds(
            0,
            10000,
            $companyIds,
            0,
            $keyword,
            $jobDepartmentIds
        );
        if ($employees->isSuccess()) {
            return new ServiceResponse(
                true,
                'Saturday permits',
                200,
                SaturdayPermit::with([
                    'employee'
                ])->whereIn('employee_id', $employees->getData()['employees']->pluck('id')->toArray())
                    ->whereBetween('date', [$startDate, $endDate])
                    ->get()
            );
        } else {
            return $employees;
        }
    }

    /**
     * @param int $employeeId
     * @param string $date
     */
    public function getByEmployeeIdAndDate(
        int    $employeeId,
        string $date,
    ): ServiceResponse
    {
        $saturdayPermit = SaturdayPermit::where('employee_id', $employeeId)->where('date', $date)->first();
        if ($saturdayPermit) {
            return new ServiceResponse(
                true,
                'Saturday permit',
                200,
                $saturdayPermit
            );
        } else {
            return new ServiceResponse(
                false,
                'Saturday permit not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $id
     * @param int $shiftGroupId
     * @param int $cancelReasonId
     * @param int $authUserId
     */
    public function cancel(
        int $id,
        int $shiftGroupId,
        int $cancelReasonId,
        int $authUserId
    ): ServiceResponse
    {
        $saturdayPermit = $this->getById($id);
        if ($saturdayPermit->isSuccess()) {
            $employee = Employee::find($saturdayPermit->getData()->employee_id);
            if ($employee) {
                $shiftGroup = ShiftGroup::find($shiftGroupId);
                if ($shiftGroup) {
                    $saturdayPermit->getData()->status = 'on';
                    $saturdayPermit->getData()->save();

                    $shift = new Shift;
                    $shift->company_id = $employee->company_id;
                    $shift->employee_id = $employee->id;
                    $shift->shift_group_id = $shiftGroupId;
                    $shift->created_by = $authUserId;
                    $shift->last_updated_by = $authUserId;
                    $shift->start_date = $saturdayPermit->getData()->date . ' ' . $shiftGroup->day6_start_time;
                    $shift->end_date = $saturdayPermit->getData()->date . ' ' . $shiftGroup->day6_end_time;
                    $shift->description = $cancelReasonId == 1 ?
                        'Cumartesi İzni İptalinden Dolayı Oluşturulan Vardiya (Ceza Puanından Dolayı İzin İptali)' :
                        ($cancelReasonId == 2 ?
                            'Cumartesi İzni İptalinden Dolayı Oluşturulan Vardiya (Çalışma Günlerinde İzin Kullanımından Dolayı)' :
                            'Cumartesi İzni İptalinden Dolayı Oluşturulan Vardiya (Belirsiz Nedenli)');
                    $shift->save();

                    return new ServiceResponse(
                        true,
                        'Saturday permit cancelled successfully',
                        200,
                        null
                    );
                } else {
                    return $shiftGroup;
                }
            } else {
                return $employee;
            }
        } else {
            return $saturdayPermit;
        }
    }
}

/*
    'company_id' => $employeeResponse->getData()->company_id,
    'employee_id' => $shift['employeeId'],
    'shift_group_id' => $shift['shiftGroupId'],
    'created_by' => $authUserId,
    'last_updated_by' => $authUserId,
    'start_date' => $shift['startDate'],
    'end_date' => $shift['endDate'],
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
 * */
