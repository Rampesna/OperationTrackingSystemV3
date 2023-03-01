<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IEmployeeSuggestionService;
use App\Models\Eloquent\Employee;
use App\Models\Eloquent\EmployeeSuggestion;
use App\Services\ServiceResponse;

class EmployeeSuggestionService implements IEmployeeSuggestionService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All employee suggestions',
            200,
            EmployeeSuggestion::all()
        );
    }

    /**
     * @param array $companyIds
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getByCompanyIds(
        array   $companyIds,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null
    ): ServiceResponse
    {
        $employeeIds = Employee::whereIn('company_id', $companyIds)->pluck('id')->toArray();
        $employeeSuggestions = EmployeeSuggestion::with([
            'employee'
        ])->whereIn('employee_id', $employeeIds);
        if ($keyword) {
            $employeeSuggestions = $employeeSuggestions->where('subject', 'like', '%' . $keyword . '%');
        }

        return new ServiceResponse(
            true,
            'Employee suggestions',
            200,
            [
                'totalCount' => $employeeSuggestions->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'employeeSuggestions' => $employeeSuggestions->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
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
        $employeeSuggestion = EmployeeSuggestion::find($id);
        if ($employeeSuggestion) {
            return new ServiceResponse(
                true,
                'Employee suggestion',
                200,
                $employeeSuggestion
            );
        } else {
            return new ServiceResponse(
                false,
                'Employee suggestion not found',
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
        $employeeSuggestion = $this->getById($id);
        if ($employeeSuggestion->isSuccess()) {
            return new ServiceResponse(
                true,
                'Employee suggestion deleted',
                200,
                $employeeSuggestion->getData()->delete()
            );
        } else {
            return $employeeSuggestion;
        }
    }

    /**
     * @param int $employeeId
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function getByEmployeeId(
        int     $employeeId,
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null
    ): ServiceResponse
    {
        $employeeSuggestions = EmployeeSuggestion::where('employee_id', $employeeId)
            ->when($keyword, function ($query, $keyword) {
                return $query->where('subject', 'like', '%' . $keyword . '%');
            })->orderBy('created_at', 'desc');

        return new ServiceResponse(
            true,
            'Employee suggestions',
            200,
            [
                'totalCount' => $employeeSuggestions->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'employeeSuggestions' => $employeeSuggestions->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $pageIndex
     * @param int $pageSize
     * @param string|null $keyword
     *
     * @return ServiceResponse
     */
    public function index(
        int     $pageIndex,
        int     $pageSize,
        ?string $keyword = null
    ): ServiceResponse
    {
        $employeeSuggestions = EmployeeSuggestion::with([
            'employee'
        ])->when($keyword, function ($query, $keyword) {
            return $query->where('subject', 'like', '%' . $keyword . '%');
        })->orderBy('created_at', 'desc');

        return new ServiceResponse(
            true,
            'Employee suggestions',
            200,
            [
                'totalCount' => $employeeSuggestions->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'employeeSuggestions' => $employeeSuggestions->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $employeeId
     * @param string $subject
     * @param string $description
     *
     * @return ServiceResponse
     */
    public function create(
        int    $employeeId,
        string $subject,
        string $description
    ): ServiceResponse
    {
        $employeeSuggestion = new EmployeeSuggestion;
        $employeeSuggestion->employee_id = $employeeId;
        $employeeSuggestion->subject = $subject;
        $employeeSuggestion->description = $description;
        $employeeSuggestion->save();
        return new ServiceResponse(
            true,
            'Employee suggestion created',
            201,
            $employeeSuggestion
        );
    }

    /**
     * @param int $id
     * @param string $subject
     * @param string $description
     *
     * @return ServiceResponse
     */
    public function update(
        int    $id,
        string $subject,
        string $description
    ): ServiceResponse
    {
        $employeeSuggestion = $this->getById($id);
        if ($employeeSuggestion->isSuccess()) {
            $employeeSuggestion->getData()->subject = $subject;
            $employeeSuggestion->getData()->description = $description;
            $employeeSuggestion->getData()->save();
            return new ServiceResponse(
                true,
                'Employee suggestion updated',
                200,
                $employeeSuggestion->getData()
            );
        } else {
            return $employeeSuggestion;
        }
    }
}
