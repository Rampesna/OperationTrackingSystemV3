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
        Schema::create('calendar_reminders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('relation_id');
            $table->string('relation_type');
            $table->dateTime('datetime');
            $table->string('title');
            $table->text('description')->nullable();
            $table->boolean('mail')->default(0);
            $table->boolean('sms')->default(0);
            $table->boolean('reminded')->default(0);
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
        Schema::dropIfExists('calendar_reminders');
    }
};
