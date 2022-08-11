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
            $table->string('relation_type');
            $table->unsignedBigInteger('relation_id');
            $table->string('creator_type');
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('priority_id');
            $table->unsignedBigInteger('subject_id')->nullable();
            $table->unsignedBigInteger('status_id');
            $table->string('title');
            $table->string('source')->nullable();
            $table->longText('description')->nullable();
            $table->longText('notes')->nullable();
            $table->dateTime('requested_end_date')->nullable();
            $table->dateTime('todo_end_date')->nullable();
            $table->unsignedBigInteger('task_id')->nullable();
            $table->unsignedBigInteger('ticket_transaction_status_id')->nullable();
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
