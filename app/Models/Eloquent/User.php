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

    public function type()
    {
        return $this->belongsTo(UserType::class);
    }

    public function role()
    {
        return $this->belongsTo(UserRole::class, 'role_id', 'id');
    }

    public function userPermissions()
    {
        return $this->role->userPermissions();
    }

    public function companies()
    {
        return $this->belongsToMany(Company::class);
    }

    public function projects()
    {
        return $this->belongsToMany(Project::class);
    }

    public function meetings()
    {
        return $this->belongsToMany(Meeting::class);
    }

    public function selectedCompanies()
    {
        return $this->belongsToMany(Company::class, 'user_selected_company');
    }

    public function marketPayments()
    {
        return $this->morphMany(MarketPayment::class, 'relation');
    }

    public function tickets()
    {
        return $this->morphMany(Ticket::class, 'creator');
    }

    public function ticketMessages()
    {
        return $this->morphMany(TicketMessage::class, 'creator');
    }

    public function centralMissions()
    {
        return $this->morphMany(CentralMission::class, 'relation');
    }

    public function timesheets()
    {
        return $this->hasMany(Timesheet::class, 'starter_id', 'id');
    }

    public function getBalanceAttribute()
    {
        $marketPayments = $this->marketPayments;
        return $marketPayments->where('direction', 0)->sum('amount') - $marketPayments->where('direction', 1)->where('completed', 1)->sum('amount');
    }

    public function getActiveTimesheetsAttribute()
    {
        return $this->timesheets()->whereNull('end_time')->get();
    }

    public function notifications()
    {
        return $this->morphMany(Notification::class, 'relation');
    }

    public function fileQuee()
    {
        return $this->morphMany(FileQuee::class, 'uploader');
    }
}
