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
        Schema::create('employee_monthly_performance_critters', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('employee_monthly_performance_id')->unsigned();
            $table->bigInteger('performance_critter_id')->unsigned();
            $table->double('result')->unsigned();
            $table->double('performance')->unsigned();
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
        Schema::dropIfExists('employee_monthly_performance_critters');
    }
};
