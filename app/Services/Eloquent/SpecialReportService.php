<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ISpecialReportService;
use App\Models\Eloquent\SpecialReport;

class SpecialReportService implements ISpecialReportService
{
    public function getAll()
    {
        return SpecialReport::all();
    }

    /**
     * @param int $id
     */
    public function getById(int $id)
    {
        return SpecialReport::find($id);
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        return SpecialReport::destroy($id);
    }

    /**
     * @param int $companyId
     */
    public function getByCompanyId(
        int $companyId
    )
    {
        return SpecialReport::where('company_id', $companyId)->get();
    }
}
