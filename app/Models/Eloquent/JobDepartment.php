<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class JobDepartment extends Model
{
    use HasFactory, SoftDeletes;

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }
}
