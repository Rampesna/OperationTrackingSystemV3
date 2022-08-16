<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IEmployeeQualityAssessmentService;
use App\Models\Eloquent\EmployeeQualityAssessment;
use App\Models\Eloquent\EmployeeQualityAssessmentParameter;
use App\Models\Eloquent\QualityAssessmentList;
use App\Services\ServiceResponse;

class EmployeeQualityAssessmentService implements IEmployeeQualityAssessmentService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All employee quality assessments',
            200,
            EmployeeQualityAssessment::all()
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
        $employeeQualityAssessment = EmployeeQualityAssessment::find($id);
        if ($employeeQualityAssessment) {
            return new ServiceResponse(
                true,
                'Employee quality assessment',
                200,
                $employeeQualityAssessment
            );
        } else {
            return new ServiceResponse(
                false,
                'Employee quality assessment not found',
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
        $employeeQualityAssessment = $this->getById($id);
        if ($employeeQualityAssessment->isSuccess()) {
            return new ServiceResponse(
                true,
                'Employee quality assessment deleted',
                200,
                $employeeQualityAssessment->getData()->delete()
            );
        } else {
            return $employeeQualityAssessment;
        }
    }

    /**
     * @param int $userId
     * @param int $qualityAssessmentTypeId
     * @param int $pageIndex
     * @param int $pageSize
     *
     * @return ServiceResponse
     */
    public function getByUserId(
        int $userId,
        int $qualityAssessmentTypeId,
        int $pageIndex,
        int $pageSize
    ): ServiceResponse
    {
        $employeeQualityAssessments = EmployeeQualityAssessment::with([
            'employee',
            'qualityAssessmentList'
        ])->orderBy('id', 'desc')->where('user_id', $userId)
            ->whereIn(
                'quality_assessment_list_id',
                QualityAssessmentList::where('quality_assessment_type_id', $qualityAssessmentTypeId)->pluck('id')->toArray()
            );

        return new ServiceResponse(
            true,
            'Employee quality assessments',
            200,
            [
                'totalCount' => $employeeQualityAssessments->count(),
                'pageIndex' => $pageIndex,
                'pageSize' => $pageSize,
                'employeeQualityAssessments' => $employeeQualityAssessments->skip($pageSize * $pageIndex)
                    ->take($pageSize)
                    ->get()
            ]
        );
    }

    /**
     * @param int $userId
     * @param int $employeeId
     * @param int $qualityAssessmentListId
     * @param string $date
     * @param string|null $callNumber
     * @param string|null $callUrl
     * @param array $parameters
     *
     * @return ServiceResponse
     */
    public function create(
        int     $userId,
        int     $employeeId,
        int     $qualityAssessmentListId,
        string  $date,
        ?string $callNumber,
        ?string $callUrl,
        array   $parameters
    ): ServiceResponse
    {
        $employeeQualityAssessment = new EmployeeQualityAssessment;
        $employeeQualityAssessment->user_id = $userId;
        $employeeQualityAssessment->employee_id = $employeeId;
        $employeeQualityAssessment->quality_assessment_list_id = $qualityAssessmentListId;
        $employeeQualityAssessment->date = $date;
        $employeeQualityAssessment->call_number = $callNumber;
        $employeeQualityAssessment->call_url = $callUrl;
        $employeeQualityAssessment->save();

        foreach ($parameters as $parameter) {
            $employeeQualityAssessmentParameter = new EmployeeQualityAssessmentParameter;
            $employeeQualityAssessmentParameter->employee_quality_assessment_id = $employeeQualityAssessment->id;
            $employeeQualityAssessmentParameter->quality_assessment_list_parameter_id = $parameter['id'];
            $employeeQualityAssessmentParameter->column_type = ' ';
            $employeeQualityAssessmentParameter->real_value = $parameter['value'];
            $employeeQualityAssessmentParameter->value = serialize($parameter['value']);
            $employeeQualityAssessmentParameter->description = $parameter['description'] ?? ' ';
            $employeeQualityAssessmentParameter->save();
        }

        return new ServiceResponse(
            true,
            'Employee quality assessment created',
            201,
            $employeeQualityAssessment
        );
    }
}
