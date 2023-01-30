<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('file_quees', function (Blueprint $table) {
            $table->id();
            $table->string('file_name');
            $table->string('file_s3_path');
            $table->integer('transaction_type_id');
            $table->integer('status_id')->default(1);
            $table->morphs('uploader');
            $table->longText('props')->nullable();
            $table->dateTime('completed_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('file_quees');
    }
};
