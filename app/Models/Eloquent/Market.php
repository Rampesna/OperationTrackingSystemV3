<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Market extends Authenticatable
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
        return $this->code;
    }

    public function role()
    {
        return $this->belongsTo(MarketRole::class, 'role_id', 'id');
    }

    public function marketPayments()
    {
        return $this->hasMany(MarketPayment::class, 'market_id', 'id');
    }

    public function getBalanceAttribute()
    {
        $marketPayments = $this->marketPayments;
        return $marketPayments->where('direction', 1)->where('completed', 1)->sum('amount') - $marketPayments->where('direction', 0)->sum('amount');
    }
}
