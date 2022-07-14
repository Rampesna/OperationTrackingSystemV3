<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IQueueService;
use App\Models\Eloquent\Queue;
use App\Services\ServiceResponse;

class QueueService implements IQueueService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All queues',
            200,
            Queue::all()
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
        $queue = Queue::find($id);
        if ($queue) {
            return new ServiceResponse(
                true,
                'Queue',
                200,
                $queue
            );
        } else {
            return new ServiceResponse(
                false,
                'Queue not found',
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
        $queue = $this->getById($id);
        if ($queue->isSuccess()) {
            return new ServiceResponse(
                true,
                'Queue deleted',
                200,
                $queue->getData()->delete()
            );
        } else {
            return new ServiceResponse(
                false,
                'Queue not found',
                404,
                null
            );
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
        $queues = Queue::with([
            'company'
        ])->whereIn('company_id', $companyIds);

        if ($keyword) {
            $queues->where(function ($query) use ($keyword) {
                $query->where('name', 'like', '%' . $keyword . '%')
                    ->orWhere('short', 'like', '%' . $keyword . '%');
            });
        }

        return new ServiceResponse(
            true,
            'Queues',
            200,
            [
                'totalCount' => $queues->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'queues' => $queues->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $queueId
     *
     * @return ServiceResponse
     */
    public function getQueueEmployees(
        int $queueId
    ): ServiceResponse
    {
        $queue = $this->getById($queueId);
        if ($queue->isSuccess()) {
            return new ServiceResponse(
                true,
                'Queue employees',
                200,
                $queue->getData()->employees
            );
        } else {
            return new ServiceResponse(
                false,
                'Queue not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $queueId
     * @param array $employeeIds
     *
     * @return ServiceResponse
     */
    public function setQueueEmployees(
        int   $queueId,
        array $employeeIds
    ): ServiceResponse
    {
        $queue = $this->getById($queueId);
        if ($queue->isSuccess()) {
            $queue->getData()->employees()->sync($employeeIds);
            return new ServiceResponse(
                true,
                'Queue employees updated',
                200,
                $queue->getData()->employees()->sync($employeeIds)
            );
        } else {
            return new ServiceResponse(
                false,
                'Queue not found',
                404,
                null
            );
        }
    }

    /**
     * @param int $companyId
     * @param string $name
     * @param string $short
     * @param int|null $groupCode
     * @param int|null $otsCode
     *
     * @return ServiceResponse
     */
    public function create(
        int    $companyId,
        string $name,
        string $short,
        ?int   $groupCode = null,
        ?int   $otsCode = null
    ): ServiceResponse
    {
        $queue = new Queue;
        $queue->company_id = $companyId;
        $queue->name = $name;
        $queue->short = $short;
        $queue->group_code = $groupCode;
        $queue->ots_code = $otsCode;
        $queue->save();

        return new ServiceResponse(
            true,
            'Queue created',
            201,
            $queue
        );
    }

    /**
     * @param int $id
     * @param int $companyId
     * @param string $name
     * @param string $short
     * @param int|null $groupCode
     * @param int|null $otsCode
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        int    $companyId,
        string $name,
        string $short,
        ?int   $groupCode = null,
        ?int   $otsCode = null
    ): ServiceResponse
    {
        $queue = $this->getById($id);
        if ($queue->isSuccess()) {
            $queue->getData()->company_id = $companyId;
            $queue->getData()->name = $name;
            $queue->getData()->short = $short;
            $queue->getData()->group_code = $groupCode;
            $queue->getData()->ots_code = $otsCode;
            $queue->getData()->save();

            return new ServiceResponse(
                true,
                'Queue updated',
                200,
                $queue->getData()
            );
        } else {
            return new ServiceResponse(
                false,
                'Queue not found',
                404,
                null
            );
        }
    }
}
