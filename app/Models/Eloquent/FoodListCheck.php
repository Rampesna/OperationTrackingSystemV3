<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodListCheck extends Model
{
    use HasFactory, SoftDeletes;

    public function foodList()
    {
        return $this->belongsTo(FoodList::class, 'food_list_id', 'id');
    }
}
