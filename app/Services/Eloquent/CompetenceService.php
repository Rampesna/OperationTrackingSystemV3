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
     */
    public function getByCompanyIds(
        array $companyIds
    )
    {
        return Competence::with([
            'company'
        ])->whereIn('company_id', $companyIds)->get();
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

}
