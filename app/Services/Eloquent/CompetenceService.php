<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ICompetenceService;
use App\Models\Eloquent\Competence;

class CompetenceService implements ICompetenceService
{
    public function getAll()
    {
        return Competence::all();
    }

    public function getById(int $id)
    {
        return Competence::find($id);
    }

    public function delete(int $id)
    {
        return Competence::destroy($id);
    }

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $companyIds
     * @param string $keyword
     */
    public function getByCompanyIds(
        array  $companyIds,
        int    $pageIndex = 0,
        int    $pageSize = 10,
        string $keyword = null
    )
    {
        $competences = Competence::with([
            'company'
        ])->whereIn('company_id', $companyIds);

        if ($keyword) {
            $competences->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%');
            });
        }

        return [
            'totalCount' => $competences->count(),
            'pageIndex' => $pageIndex,
            'pageSize' => $pageSize,
            'competences' => $competences->skip($pageSize * $pageIndex)
                ->take($pageSize)
                ->get()
        ];
    }

    /**
     * @param int $competenceId
     */
    public function getCompetenceEmployees(
        int $competenceId
    )
    {
        return $this->getById($competenceId)->employees;
    }

    /**
     * @param int $competenceId
     * @param array $employeeIds
     */
    public function setCompetenceEmployees(
        int   $competenceId,
        array $employeeIds
    )
    {
        $competence = $this->getById($competenceId);
        $competence->employees()->sync($employeeIds);
    }

    /**
     * @param int $companyId
     * @param string $name
     */
    public function create(
        int    $companyId,
        string $name
    )
    {
        $competence = new Competence();
        $competence->company_id = $companyId;
        $competence->name = $name;
        $competence->save();

        return $competence;
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name
    )
    {
        $competence = $this->getById($id);
        $competence->company_id = $companyId;
        $competence->name = $name;
        $competence->save();

        return $competence;
    }
}
