<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserRole extends Model
{
    use HasFactory, SoftDeletes;

    public function users()
    {
        return $this->hasMany(User::class, 'role_id', 'id');
    }

    public function userPermissions()
    {
        return $this->belongsToMany(UserPermission::class);
    }
}
