<?php

namespace App\Models\Eloquent;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FileQuee extends Model
{
    use HasFactory,SoftDeletes;


    public function uploader(){
        return $this->morphTo();
    }

    public function transaction(){
        return $this->belongsTo(FileQueeTransactionTypes::class, 'transaction_type_id', 'id');
    }

    public function status(){
        return $this->belongsTo(FileQueeStatuses::class, 'status_id', 'id');
    }

}
