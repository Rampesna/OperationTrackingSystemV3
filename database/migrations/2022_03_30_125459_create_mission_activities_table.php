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
        Schema::create('mission_activities', function (Blueprint $table) {
            $table->id();
            $table->string('relation_type');
            $table->unsignedBigInteger('relation_id');
            $table->unsignedBigInteger('mission_id');
            $table->unsignedBigInteger('status_id');
            $table->text('description');
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
        Schema::dropIfExists('mission_activities');
    }
};
