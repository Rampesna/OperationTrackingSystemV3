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
use App\Services\OperationApi\OperationService;
use App\Services\OperationApi\PersonSystemService;
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

                    $staffParameter = [
                        [
                            'vardiyaId' => $shift->id,
                            'kullanicilarId' => $employee->guid,
                            'tarih' => date('Y-m-d', strtotime($shift->start_date)),
                            'yemekBaslangicSaati' => date('Y-m-d', strtotime($shift->start_date)) . ' ' . $shiftGroup->food_break_start,
                            'yemekBitisSaati' => date('Y-m-d', strtotime($shift->start_date)) . ' ' . $shiftGroup->food_break_end,
                            'yemekMolasindaIhtiyacMolasi' => $shiftGroup->get_break_while_food_time,
                            'yemekMolasiDisindaYemekMolasi' => $shiftGroup->get_food_break_without_food_time,
                            'birMolaHakkiDakikasi' => $shiftGroup->single_break_duration,
                            'vardiyaBasiIlkMolaHakkiDakikasi' => $shiftGroup->get_first_break_after_shift_start,
                            'vardiyaSonuMolaYasagiDakikasi' => $shiftGroup->get_last_break_before_shift_end,
                            'sonMoladanSonraMolaMusadesiDakikasi' => $shiftGroup->get_break_after_last_break,
                            'gunlukYemekMolasiHakkiSayisi' => $shiftGroup->daily_food_break_amount,
                            'gunlukToplamMolaDakikasi' => $shiftGroup->daily_break_duration,
                            'gunlukYemekMolasiDakikasi' => $shiftGroup->daily_food_break_duration,
                            'gunlukIhtiyacMolasiDakikasi' => $shiftGroup->daily_break_break_duration,
                            'anlikYemekMolasiDakikasi' => $shiftGroup->momentary_food_break_duration,
                            'anlikIhtiyacMolasiDakikasi' => $shiftGroup->momentary_break_break_duration,
                            'molaKullanimKisitlamasiVarMi' => $shiftGroup->suspend_break_using,
                        ]
                    ];

                    $personSystemService = new PersonSystemService;
                    $personSystemService->SetPersonAddPenalty(
                        $employee->guid,
                        $cancelReasonId
                    );

                    $operationService = new OperationService;
                    $operationService->SetStaffParameter($staffParameter);

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
