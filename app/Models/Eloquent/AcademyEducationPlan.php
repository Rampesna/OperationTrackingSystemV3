<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class AcademyEducationPlan extends Model
{
    use HasFactory, SoftDeletes;

    public function academyEducationPlanType()
    {
        return $this->belongsTo(AcademyEducationPlanType::class);
    }

    public function academyEducationLesson()
    {
        return $this->belongsTo(AcademyEducationLesson::class);
    }
}
