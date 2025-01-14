<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KnowledgeBaseQuestionCategory extends Model
{
    use HasFactory, SoftDeletes;

    public function questions()
    {
        return $this->hasMany(KnowledgeBaseQuestion::class, 'category_id', 'id');
    }
}
