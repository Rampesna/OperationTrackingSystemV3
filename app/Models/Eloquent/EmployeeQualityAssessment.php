<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class EmployeeQualityAssessment extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = [
        'point'
    ];

    public function employee()
    {
        return $this->belongsTo(Employee::class);
    }

    public function qualityAssessmentList()
    {
        return $this->belongsTo(QualityAssessmentList::class, 'quality_assessment_list_id', 'id');
    }

    public function getPointAttribute()
    {
        return EmployeeQualityAssessmentParameter::where('employee_quality_assessment_id', $this->id)->sum('real_value');
    }
}
