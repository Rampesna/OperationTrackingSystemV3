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
        Schema::create('food_list_checks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('food_list_id');
            $table->unsignedBigInteger('employee_id');
            $table->tinyInteger('count')->unsigned();
            $table->boolean('checked')->nullable();
            $table->boolean('liked')->nullable();
            $table->boolean('locked')->nullable();
            $table->boolean('ate')->nullable();
            $table->text('description')->nullable();
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
        Schema::dropIfExists('food_list_checks');
    }
};
