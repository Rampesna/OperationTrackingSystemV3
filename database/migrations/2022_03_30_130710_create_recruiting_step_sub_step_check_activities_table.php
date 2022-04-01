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
        Schema::create('recruiting_step_sub_step_check_activities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recruiting_step_sub_step_check_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('check');
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
        Schema::dropIfExists('recruiting_step_sub_step_check_activities');
    }
};
