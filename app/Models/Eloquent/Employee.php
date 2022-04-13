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

    public function jobDepartments()
    {
        return $this->belongsToMany(JobDepartment::class);
    }
}
