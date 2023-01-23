<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PRCard extends Model
{
    use HasFactory, SoftDeletes;

    public function jobDepartment()
    {
        return $this->belongsTo(JobDepartment::class);
    }

    public function prCritters()
    {
        return $this->hasMany(PRCritter::class);
    }
}
