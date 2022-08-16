<?php

namespace App\Services\Eloquent;

use App\Interfaces\Eloquent\IQualityAssessmentListService;
use App\Models\Eloquent\QualityAssessmentList;
use App\Services\ServiceResponse;

class QualityAssessmentListService implements IQualityAssessmentListService
{
    /**
     * @return ServiceResponse
     */
    public function getAll(): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'All quality assessment lists',
            200,
            QualityAssessmentList::all()
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
        $qualityAssessmentList = QualityAssessmentList::find($id);
        if ($qualityAssessmentList) {
            return new ServiceResponse(
                true,
                'Quality assessment list',
                200,
                $qualityAssessmentList
            );
        } else {
            return new ServiceResponse(
                false,
                'Quality assessment list not found',
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
        $qualityAssessmentList = $this->getById($id);
        if ($qualityAssessmentList->isSuccess()) {
            return new ServiceResponse(
                true,
                'Quality assessment list deleted',
                200,
                $qualityAssessmentList->getData()->delete()
            );
        } else {
            return $qualityAssessmentList;
        }
    }

    /**
     * @param int $qualityAssessmentTypeId
     *
     * @return ServiceResponse
     */
    public function getByQualityAssessmentTypeId(
        int $qualityAssessmentTypeId
    ): ServiceResponse
    {
        return new ServiceResponse(
            true,
            'Quality assessment lists',
            200,
            QualityAssessmentList::where('quality_assessment_type_id', $qualityAssessmentTypeId)->get()
        );
    }

    /**
     * @param int $id
     *
     * @return ServiceResponse
     */
    public function getParametersById(
        int $id
    ): ServiceResponse
    {
        $qualityAssessmentList = QualityAssessmentList::with([
            'qualityAssessmentType',
            'parameters' => function ($parameters) {
                $parameters->with([
                    'type',
                    'values'
                ]);
            }
        ])->find($id);
        if ($qualityAssessmentList) {
            return new ServiceResponse(
                true,
                'Quality assessment list parameters',
                200,
                $qualityAssessmentList
            );
        } else {
            return new ServiceResponse(
                false,
                'Quality assessment list not found',
                404,
                null
            );
        }
    }
}
