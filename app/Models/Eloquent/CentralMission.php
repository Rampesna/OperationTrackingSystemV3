<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CentralMission extends Model
{
    use HasFactory, SoftDeletes;

    function type()
    {
        return $this->belongsTo(CentralMissionType::class, 'type_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(CentralMissionStatus::class, 'status_id', 'id');
    }

    public function relation()
    {
        return $this->morphTo();
    }
}
