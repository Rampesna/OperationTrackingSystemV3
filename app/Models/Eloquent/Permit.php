<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permit extends Model
{
    use HasFactory, SoftDeletes;

    public function status()
    {
        return $this->belongsTo(PermitStatus::class, 'status_id', 'id');
    }

    public function type()
    {
        return $this->belongsTo(PermitType::class, 'type_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }
}
