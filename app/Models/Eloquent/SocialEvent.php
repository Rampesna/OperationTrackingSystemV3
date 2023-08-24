<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialEvent extends Model
{
    use HasFactory, SoftDeletes;

    public function images()
    {
        return $this->morphMany(File::class, 'relation');
    }
}
