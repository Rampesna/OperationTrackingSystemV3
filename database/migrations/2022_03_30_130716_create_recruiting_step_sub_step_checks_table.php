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
        Schema::create('recruiting_step_sub_step_checks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recruiting_id');
            $table->unsignedBigInteger('recruiting_step_id');
            $table->unsignedBigInteger('recruiting_step_sub_step_id');
            $table->unsignedBigInteger('user_id');
            $table->boolean('check')->default(0);
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
        Schema::dropIfExists('recruiting_step_sub_step_checks');
    }
};
