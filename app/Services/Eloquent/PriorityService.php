<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IPriorityService;
use App\Models\Eloquent\Priority;

class PriorityService implements IPriorityService
{
    public function getAll()
    {
        return Priority::all();
    }

    public function getById(int $id)
    {
        return Priority::find($id);
    }

    public function delete(int $id)
    {
        return Priority::destroy($id);
    }

    public function getByCompanyId($companyId)
    {
        return Priority::where('company_id', $companyId)->get();
    }

    /**
     * @param int $queueId
     */
    public function getPriorityEmployees(
        int $queueId
    )
    {
        return $this->getById($queueId)->employees;
    }

    /**
     * @param int $queueId
     * @param array $employeeIds
     */
    public function setPriorityEmployees(
        int   $queueId,
        array $employeeIds
    )
    {
        $priority = $this->getById($queueId);
        $priority->employees()->sync($employeeIds);
    }
}
