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
        $queues = Queue::with([
            'company'
        ])->whereIn('company_id', $companyIds);

        if ($keyword) {
            $queues->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('short', 'like', '%' . $keyword . '%');
            });
        }

        return [
            'totalCount' => $queues->count(),
            'pageIndex' => $pageIndex,
            'pageSize' => $pageSize,
            'queues' => $queues->skip($pageSize * $pageIndex)
                ->take($pageSize)
                ->get()
        ];
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

    /**
     * @param int $companyId
     * @param string $name
     * @param string $short
     * @param int|null $groupCode
     * @param int|null $otsCode
     */
    public function create(
        int    $companyId,
        string $name,
        string $short,
        ?int   $groupCode = null,
        ?int   $otsCode = null
    )
    {
        $queue = new Queue;
        $queue->company_id = $companyId;
        $queue->name = $name;
        $queue->short = $short;
        $queue->group_code = $groupCode;
        $queue->ots_code = $otsCode;
        $queue->save();

        return $queue;
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     * @param string $short
     * @param int|null $groupCode
     * @param int|null $otsCode
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name,
        string $short,
        ?int   $groupCode = null,
        ?int   $otsCode = null
    )
    {
        $queue = $this->getById($id);
        $queue->company_id = $companyId;
        $queue->name = $name;
        $queue->short = $short;
        $queue->group_code = $groupCode;
        $queue->ots_code = $otsCode;
        $queue->save();

        return $queue;
    }
}
