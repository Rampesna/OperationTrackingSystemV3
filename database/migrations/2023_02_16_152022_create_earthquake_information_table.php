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
        Schema::create('earthquake_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('city_id')->nullable();
            $table->text('address')->nullable();
            $table->string('home_status')->nullable();
            $table->string('family_health_status')->nullable();
            $table->string('work_status')->nullable();
            $table->string('computer_status')->nullable();
            $table->string('internet_status')->nullable();
            $table->string('headphone_status')->nullable();
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
        Schema::dropIfExists('earthquake_information');
    }
};
