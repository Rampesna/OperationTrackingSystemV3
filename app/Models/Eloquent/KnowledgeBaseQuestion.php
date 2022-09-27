<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class KnowledgeBaseQuestion extends Model
{
    use HasFactory, SoftDeletes;

    public function creator()
    {
        return $this->morphTo();
    }

    public function category()
    {
        return $this->belongsTo(KnowledgeBaseQuestionCategory::class, 'category_id', 'id');
    }
}
