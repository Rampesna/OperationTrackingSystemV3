<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ticket extends Model
{
    use HasFactory, SoftDeletes;

    public function relation()
    {
        return $this->morphTo();
    }

    public function creator()
    {
        return $this->morphTo();
    }

    public function priority()
    {
        return $this->belongsTo(TicketPriority::class, 'priority_id', 'id');
    }

    public function status()
    {
        return $this->belongsTo(TicketStatus::class, 'status_id', 'id');
    }
}
