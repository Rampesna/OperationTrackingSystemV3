<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ISpecialReportService;
use App\Models\Eloquent\SpecialReport;
use App\Services\ServiceResponse;

class SpecialReportService implements ISpecialReportService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All special reports',
            200,
            SpecialReport::all()
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
        $specialReport = SpecialReport::find($id);
        if ($specialReport) {
            return new ServiceResponse(
                true,
                'Special report',
                200,
                $specialReport
            );
        } else {
            return new ServiceResponse(
                false,
                'Special report not found',
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
        $specialReport = $this->getById($id);
        if ($specialReport->isSuccess()) {
            return new ServiceResponse(
                true,
                'Special report deleted',
                200,
                $specialReport->getData()->delete()
            );
        } else {
            return new ServiceResponse(
                false,
                'Special report not found',
                404,
                null
            );
        }
    }

    /**
     * @param array $companyIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array $companyIds
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Special reports',
            200,
            SpecialReport::with([
                'company',
            ])->whereIn('company_id', $companyIds)->get()
        );
    }
}
