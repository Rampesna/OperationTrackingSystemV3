<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\ITimesheetService;
use App\Models\Eloquent\Timesheet;
use App\Services\ServiceResponse;

class TimesheetService implements ITimesheetService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All timesheets',
            200,
            Timesheet::all()
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
        $timesheet = Timesheet::find($id);
        if ($timesheet) {
            return new ServiceResponse(
                true,
                'Timesheet',
                200,
                $timesheet
            );
        } else {
            return new ServiceResponse(
                false,
                'Timesheet not found',
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
        $timesheet = $this->getById($id);
        if ($timesheet->isSuccess()) {
            return new ServiceResponse(
                $timesheet->getData()->delete(),
                'Timesheet deleted',
                200,
                null
            );
        } else {
            return $timesheet;
        }
    }

    /**
     * @param int $taskId
     * @param int $starterId
     * @param string $startTime
     *
     * @return ServiceResponse
     */
    public function create(
        int    $taskId,
        int    $starterId,
        string $startTime
    ): ServiceResponse
    {
        $timesheet = new Timesheet();
        $timesheet->task_id = $taskId;
        $timesheet->starter_id = $starterId;
        $timesheet->start_time = $startTime;
        $timesheet->save();

        return new ServiceResponse(
            true,
            'Timesheet created',
            201,
            $timesheet
        );
    }

    /**
     * @param int $id
     * @param string $endTime
     * @param string|null $description
     *
     * @return ServiceResponse
     */
    public function setEndTime(
        int     $id,
        string  $endTime,
        ?string $description = null
    ): ServiceResponse
    {
        $timesheet = $this->getById($id);
        if ($timesheet->isSuccess()) {
            $timesheet->getData()->end_time = $endTime;
            $timesheet->getData()->description = $description;
            $timesheet->getData()->save();

            return new ServiceResponse(
                true,
                'Timesheet updated',
                200,
                $timesheet->getData()
            );
        } else {
            return $timesheet;
        }
    }

    /**
     * @return ServiceResponse
     */
    public function getActiveTimesheets(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All active timesheets',
            200,
            Timesheet::with([
                'starter',
                'task' => function ($task) {
                    return $task->with([
                        'board' => function ($board) {
                            return $board->with('project');
                        }
                    ]);
                }
            ])->orderBy('start_time')->whereNull('end_time')->get()
        );
    }

    /**
     * @param string $startDate
     * @param string $endDate
     *
     * @return ServiceResponse
     */
    public function getDateBetween(
        string $startDate,
        string $endDate
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All timesheets between dates',
            200,
            Timesheet::with([
                'starter',
                'task' => function ($task) {
                    return $task->with([
                        'board' => function ($board) {
                            return $board->with('project');
                        }
                    ]);
                }
            ])->orderBy('start_time')->whereBetween('start_time', [$startDate, $endDate])->get()
        );
    }
}
