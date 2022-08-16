<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class QualityAssessmentList extends Model
{
    use HasFactory, SoftDeletes;

    public function qualityAssessmentType()
    {
        return $this->belongsTo(QualityAssessmentType::class, 'quality_assessment_type_id', 'id');
    }

    public function parameters()
    {
        return $this->hasMany(QualityAssessmentListParameter::class, 'quality_assessment_list_id', 'id');
    }
}
