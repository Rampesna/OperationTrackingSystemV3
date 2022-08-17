<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IRecruitingService;
use App\Models\Eloquent\Recruiting;
use App\Services\ServiceResponse;

class RecruitingService implements IRecruitingService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All recruitings',
            200,
            Recruiting::all()
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
        $recruiting = Recruiting::find($id);
        if ($recruiting) {
            return new ServiceResponse(
                true,
                'Recruiting',
                200,
                $recruiting
            );
        } else {
            return new ServiceResponse(
                false,
                'Recruiting not found',
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
        $recruiting = $this->getById($id);
        if ($recruiting->isSuccess()) {
            return new ServiceResponse(
                true,
                'Recruiting deleted',
                200,
                $recruiting->getData()->delete()
            );
        } else {
            return $recruiting;
        }
    }

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     * @param array|null $departmentIds
     * @param array|null $stepIds
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array   $companyIds,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null,
        ?array  $departmentIds = [],
        ?array  $stepIds = []
    ): ServiceResponse
    {
        $recruitings = Recruiting::with([
            'company',
            'department',
            'step',
        ])->orderBy('id', 'desc')->whereIn('company_id', $companyIds);

        if ($keyword) {
            $recruitings->where(function ($recruitings) use ($keyword) {
                $recruitings->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('email', 'like', '%' . $keyword . '%')
                    ->orWhere('phone_number', 'like', '%' . $keyword . '%')
                    ->orWhere('identity', 'like', '%' . $keyword . '%');
            });
        }

        if ($departmentIds) {
            $recruitings->whereIn('department_id', $departmentIds);
        }

        if ($stepIds) {
            $recruitings->whereIn('step_id', $stepIds);
        }

        return new ServiceResponse(
            true,
            'Recruitings',
            200,
            [
                'totalCount' => $recruitings->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'recruitings' => $recruitings->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }
}
