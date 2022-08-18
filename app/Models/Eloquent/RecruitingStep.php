<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RecruitingStep extends Model
{
    use HasFactory, SoftDeletes;

    public function subSteps()
    {
        return $this->hasMany(RecruitingStepSubStep::class, 'recruiting_step_id', 'id');
    }
}
