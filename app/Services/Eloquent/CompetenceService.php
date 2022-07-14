<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ICompetenceService;
use App\Models\Eloquent\Competence;
use App\Services\ServiceResponse;

class CompetenceService implements ICompetenceService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All competences',
            200,
            Competence::all()
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
        $competence = Competence::find($id);
        if ($competence) {
            return new ServiceResponse(
                true,
                'Competence',
                200,
                $competence
            );
        } else {
            return new ServiceResponse(
                false,
                'Competence not found',
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
        $competence = $this->getById($id);
        if ($competence->isSuccess()) {
            return new ServiceResponse(
                true,
                'Competence deleted',
                200,
                $competence->getData()->delete()
            );
        } else {
            return $competence;
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
        $competences = Competence::with([
            'company'
        ])->whereIn('company_id', $companyIds);

        if ($keyword) {
            $competences->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        return new ServiceResponse(
            true,
            'Competences',
            200,
            [
                'totalCount' => $competences->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'competences' => $competences->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $competenceId
     *
     * @return ServiceResponse
     */
    public function getCompetenceEmployees(
        int $competenceId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Competence employees',
            200,
            $this->getById($competenceId)->getData()->employees
        );
    }

    /**
     * @param int $competenceId
     * @param array $employeeIds
     *
     * @return ServiceResponse
     */
    public function setCompetenceEmployees(
        int   $competenceId,
        array $employeeIds
    ): ServiceResponse
    {
        $competence = $this->getById($competenceId);
        if ($competence->isSuccess()) {
            return new ServiceResponse(
                true,
                'Competence employees synced',
                200,
                $competence->getData()->employees()->sync($employeeIds)
            );
        } else {
            return $competence;
        }
    }

    /**
     * @param int $companyId
     * @param string $name
     *
     * @return ServiceResponse
     */
    public function create(
        int    $companyId,
        string $name
    ): ServiceResponse
    {
        $competence = new Competence();
        $competence->company_id = $companyId;
        $competence->name = $name;
        $competence->save();

        return new ServiceResponse(
            true,
            'Competence created',
            201,
            $competence
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
        $competence = $this->getById($id);
        if ($competence->isSuccess()) {
            $competence->getData()->company_id = $companyId;
            $competence->getData()->name = $name;
            $competence->getData()->save();

            return new ServiceResponse(
                true,
                'Competence updated',
                200,
                $competence->getData()
            );
        } else {
            return $competence;
        }
    }
}
