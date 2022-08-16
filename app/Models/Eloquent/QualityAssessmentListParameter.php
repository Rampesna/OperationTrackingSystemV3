<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QualityAssessmentListParameter extends Model
{
    use HasFactory, SoftDeletes;

    public function type()
    {
        return $this->belongsTo(QualityAssessmentListParameterType::class, 'quality_assessment_list_parameter_type_id', 'id');
    }

    public function values()
    {
        return $this->hasMany(QualityAssessmentListParameterValue::class, 'quality_assessment_list_parameter_id', 'id');
    }
}
