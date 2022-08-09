<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PurchaseStatus extends Model
{
    use HasFactory, SoftDeletes;

    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
}
