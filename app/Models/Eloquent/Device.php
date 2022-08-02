<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Device extends Model
{
    use HasFactory, SoftDeletes;

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id', 'id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'employee_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(DeviceStatus::class, 'status_id', 'id');
    }

    public function category()
    {
        return $this->belongsTo(DeviceCategory::class, 'category_id', 'id');
    }

    public function package()
    {
        return $this->belongsTo(DevicePackage::class, 'package_id', 'id');
    }
}
