<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
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

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id', 'id');
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function selectedCompanies()
    {
        return $this->belongsToMany(Company::class, 'user_selected_company');
    }

    public function marketPayments()
    {
        return $this->morphMany(MarketPayment::class, 'relation');
    }
}
