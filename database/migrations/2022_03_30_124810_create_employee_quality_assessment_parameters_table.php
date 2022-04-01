<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employee_quality_assessment_parameters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_quality_assessment_id');
            $table->unsignedBigInteger('quality_assessment_list_parameter_id');
            $table->string('column_type');
            $table->text('real_value');
            $table->text('value');
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
        Schema::dropIfExists('employee_quality_assessment_parameters');
    }
};
