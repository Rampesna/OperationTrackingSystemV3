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
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->string('creator_type');
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('priority_id');
            $table->unsignedBigInteger('subject_id');
            $table->unsignedBigInteger('status_id');
            $table->unsignedBigInteger('title');
            $table->longText('description')->nullable();
            $table->dateTime('requested_end_date')->nullable();
            $table->dateTime('todo_end_date')->nullable();
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
        Schema::dropIfExists('tickets');
    }
};
