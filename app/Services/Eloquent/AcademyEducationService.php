<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IAcademyEducationService;
use App\Models\Eloquent\AcademyEducation;
use App\Services\ServiceResponse;

class AcademyEducationService implements IAcademyEducationService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All academy educations',
            200,
            AcademyEducation::all()
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
        $academyEducation = AcademyEducation::find($id);
        if ($academyEducation) {
            return new ServiceResponse(
                true,
                'Academy education',
                200,
                $academyEducation
            );
        } else {
            return new ServiceResponse(
                false,
                'Academy education not found',
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
        $academyEducation = $this->getById($id);
        if ($academyEducation->isSuccess()) {
            return new ServiceResponse(
                true,
                'Academy education deleted',
                200,
                $academyEducation->getData()->delete()
            );
        } else {
            return $academyEducation;
        }
    }

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $companyIds
     * @param string $keyword
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array  $companyIds,
        int    $pageIndex = 0,
        int    $pageSize = 10,
        string $keyword = null
    ): ServiceResponse
    {
        $academyEducations = AcademyEducation::with([
            'company'
        ])->whereIn('company_id', $companyIds);

        if ($keyword) {
            $academyEducations->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        return new ServiceResponse(
            true,
            'Academy educations',
            200,
            [
                'totalCount' => $academyEducations->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'academyEducations' => $academyEducations->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $companyId
     * @param string $name
     * @param int|null $typeId
     *
     * @return ServiceResponse
     */
    public function create(
        int    $companyId,
        string $name
    ): ServiceResponse
    {
        $academyEducation = new AcademyEducation;
        $academyEducation->company_id = $companyId;
        $academyEducation->name = $name;
        $academyEducation->save();

        return new ServiceResponse(
            true,
            'Academy education created',
            201,
            $academyEducation
        );
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name
    ): ServiceResponse
    {
        $academyEducation = $this->getById($id);
        if ($academyEducation->isSuccess()) {
            $academyEducation->getData()->company_id = $companyId;
            $academyEducation->getData()->name = $name;
            $academyEducation->getData()->save();

            return new ServiceResponse(
                true,
                'Academy education updated',
                200,
                $academyEducation->getData()
            );
        } else {
            return $academyEducation;
        }
    }
}
