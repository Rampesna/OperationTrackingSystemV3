<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ICompanyService;
use App\Interfaces\Eloquent\IEmployeeService;
use App\Interfaces\Eloquent\ISaturdayPermitService;
use App\Models\Eloquent\SaturdayPermit;
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
        IEmployeeService $employeeService
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
            if ($day == 25) break;
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
                            // HATALI $saturdayPermit->status = $company->saturday_permit_reverse == 1 ? 'off' : 'on';
                            // DENENECEK $saturdayPermit->status = $company->saturday_permit_reverse == 1 ? $employee->saturday_permit_order == 1 ? 'on' : 'off' : 'on';
                            $saturdayPermit->status = $company->saturday_permit_reverse == 1 ? 'off' : 'on';
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
}
