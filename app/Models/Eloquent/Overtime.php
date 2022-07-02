<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Overtime extends Model
{
    use HasFactory, SoftDeletes;

    public function status()
    {
        return $this->belongsTo(OvertimeStatus::class);
    }

    public function type()
    {
        return $this->belongsTo(OvertimeType::class);
    }
}
