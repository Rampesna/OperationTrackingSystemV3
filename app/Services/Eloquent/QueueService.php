<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IQueueService;
use App\Models\Eloquent\Queue;

class QueueService implements IQueueService
{
    public function getAll()
    {
        return Queue::all();
    }

    /**
     * @param int $id
     */
    public function getById(
        int $id
    )
    {
        return Queue::find($id);
    }

    /**
     * @param int $companyId
     */
    public function delete(
        int $id
    )
    {
        return Queue::destroy($id);
    }

    /**
     * @param int $companyId
     */
    public function getByCompanyId(
        int $companyId
    )
    {
        return Queue::where('company_id', $companyId)->get();
    }

    /**
     * @param int $queueId
     */
    public function getQueueEmployees(
        int $queueId
    )
    {
        return $this->getById($queueId)->employees;
    }

    /**
     * @param int $queueId
     * @param array $employeeIds
     */
    public function setQueueEmployees(
        int   $queueId,
        array $employeeIds
    )
    {
        $queue = $this->getById($queueId);
        $queue->employees()->sync($employeeIds);
    }
}
