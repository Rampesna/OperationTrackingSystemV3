<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Meeting extends Model
{
    use HasFactory, SoftDeletes;

    public function type()
    {
        return $this->belongsTo(MeetingType::class, 'type_id', 'id');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function meetingAgendas()
    {
        return $this->hasMany(MeetingAgenda::class, 'meeting_id', 'id');
    }
}
