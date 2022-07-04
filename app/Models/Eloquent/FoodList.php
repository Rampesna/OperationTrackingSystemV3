<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FoodList extends Model
{
    use HasFactory, SoftDeletes;

    public function foodListChecks()
    {
        return $this->hasMany(FoodListCheck::class, 'food_list_id', 'id');
    }
}
