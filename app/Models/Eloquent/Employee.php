<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Employee extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    public function apiToken()
    {
        return $this->api_token;
    }

    public function theme()
    {
        return $this->theme;
    }

    public function name()
    {
        return $this->name;
    }

    public function email()
    {
        return $this->email;
    }

    public function personalInformation()
    {
        return $this->hasOne(EmployeePersonalInformation::class, 'employee_id', 'id');
    }

    public function role()
    {
        return $this->belongsTo(EmployeeRole::class, 'role_id', 'id');
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function queues()
    {
        return $this->belongsToMany(Queue::class);
    }

    public function competences()
    {
        return $this->belongsToMany(Competence::class);
    }

    public function jobDepartment()
    {
        return $this->belongsTo(JobDepartment::class);
    }

    public function shiftGroups()
    {
        return $this->belongsToMany(ShiftGroup::class);
    }

    public function marketPayments()
    {
        return $this->morphMany(MarketPayment::class, 'relation');
    }

    public function centralMissions()
    {
        return $this->morphMany(CentralMission::class, 'relation');
    }

    public function getBalanceAttribute()
    {
        $marketPayments = $this->marketPayments;
        return $marketPayments->where('direction', 0)->sum('amount') - $marketPayments->where('direction', 1)->where('completed', 1)->sum('amount');
    }

    public function shifts()
    {
        return $this->hasMany(Shift::class);
    }

    public function devices()
    {
        return $this->hasMany(Device::class, 'employee_id', 'id');
    }
}
