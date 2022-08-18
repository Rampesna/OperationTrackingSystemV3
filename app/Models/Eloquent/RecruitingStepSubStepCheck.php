<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecruitingStepSubStepCheck extends Model
{
    use HasFactory, SoftDeletes;

    public function recruitingStepSubStep()
    {
        return $this->belongsTo(RecruitingStepSubStep::class, 'recruiting_step_sub_step_id', 'id');
    }
}
