<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Timesheet extends Model
{
    use HasFactory, SoftDeletes;

    public function task()
    {
        return $this->belongsTo(Task::class, 'task_id', 'id');
    }

    public function starter()
    {
        return $this->belongsTo(User::class, 'starter_id', 'id');
    }
}
