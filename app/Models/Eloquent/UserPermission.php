<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserPermission extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $appends = [
        'children',
    ];

    public function userRoles()
    {
        return $this->belongsToMany(UserRole::class);
    }

    public function getChildrenAttribute()
    {
        return UserPermission::where('top_id', $this->id)->get();
    }
}
