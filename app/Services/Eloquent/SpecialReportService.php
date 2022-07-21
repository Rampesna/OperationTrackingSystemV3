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
            return $specialReport;
        }
    }

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array       $companyIds,
        int         $pageIndex = 0,
        int         $pageSize = 10,
        string|null $keyword = null
    ): ServiceResponse
    {
        $specialReports = SpecialReport::with([
            'company'
        ])->whereIn('company_id', $companyIds);

        if ($keyword) {
            $specialReports->where('name', 'like', '%' . $keyword . '%');
        }

        return new ServiceResponse(
            true,
            'Special reports',
            200,
            [
                'totalCount' => $specialReports->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'specialReports' => $specialReports->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $companyId
     * @param string $name
     * @param string $query
     *
     * @return ServiceResponse
     */
    public function create(
        int    $companyId,
        string $name,
        string $query
    ): ServiceResponse
    {
        $specialReport = new SpecialReport;
        $specialReport->company_id = $companyId;
        $specialReport->name = $name;
        $specialReport->query = $query;
        $specialReport->save();

        return new ServiceResponse(
            true,
            'Special report created',
            201,
            $specialReport
        );
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     * @param string $query
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name,
        string $query
    ): ServiceResponse
    {
        $specialReport = $this->getById($id);
        if ($specialReport->isSuccess()) {
            $specialReport->getData()->company_id = $companyId;
            $specialReport->getData()->name = $name;
            $specialReport->getData()->query = $query;
            $specialReport->getData()->save();

            return new ServiceResponse(
                true,
                'Special report updated',
                200,
                $specialReport->getData()
            );
        } else {
            return $specialReport;
        }
    }
}
