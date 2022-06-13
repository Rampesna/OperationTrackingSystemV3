<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShiftGroup extends Model
{
    use HasFactory, SoftDeletes;

    protected $appends = [
        'employees_count',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function employees()
    {
        return $this->belongsToMany(Employee::class);
    }

    public function getEmployeesCountAttribute()
    {
        return $this->employees()->count();
    }
}
