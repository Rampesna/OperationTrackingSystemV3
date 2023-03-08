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
        Schema::create('employee_skill_inventories', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('central_code')->nullable();
            $table->string('department')->nullable();
            $table->string('education_level')->nullable();
            $table->text('languages')->nullable();
            $table->text('certificates')->nullable();
            $table->text('job_start_date')->nullable();
            $table->text('products')->nullable();
            $table->text('total_work_experience')->nullable();
            $table->text('age')->nullable();
            $table->text('gender')->nullable();
            $table->text('hobbies')->nullable();
            $table->text('old_work_companies')->nullable();
            $table->text('old_work_positions')->nullable();
            $table->text('future_works_taken')->nullable();
            $table->text('notes')->nullable();
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
        Schema::dropIfExists('employee_skill_inventories');
    }
};
