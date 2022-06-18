<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasFactory, SoftDeletes;

    public function boards()
    {
        return $this->hasMany(Board::class);
    }

    public function tasks()
    {
        return $this->hasManyThrough(Task::class, Board::class);
    }

    public function subTasks()
    {
        return $this->hasManyDeep(SubTask::class, [Board::class, Task::class])->where('management', 0);
    }

    public function managementSubTasks()
    {
        return $this->hasManyDeep(SubTask::class, [Board::class, Task::class])->where('management', 1);
    }

    public function timesheets()
    {
        return $this->hasManyDeep(Timesheet::class, [Board::class, Task::class]);
    }

    public function milestones()
    {
        return $this->hasMany(Milestone::class);
    }

    public function files()
    {
        return $this->morphMany(File::class, 'relation');
    }

    public function comments()
    {
        return $this->morphMany(Comment::class, 'relation');
    }

    public function notes()
    {
        return $this->morphMany(Note::class, 'relation');
    }

    public function employees()
    {
        return $this->morphedByMany(Employee::class, 'connection', 'project_connections', 'project_id', 'connection_id');
    }

    public function users()
    {
        return $this->morphedByMany(User::class, 'connection', 'project_connections', 'project_id', 'connection_id');
    }
}
