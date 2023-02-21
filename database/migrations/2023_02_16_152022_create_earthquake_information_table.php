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
            $table->string('city')->nullable();
            $table->text('address')->nullable();
            $table->string('home_status')->nullable();
            $table->string('family_health_status')->nullable();
            $table->string('working_status')->nullable();
            $table->string('working_address')->nullable();
            $table->string('working_department')->nullable();
            $table->date('workable_date')->nullable();
            $table->string('computer_status')->nullable();
            $table->string('internet_status')->nullable();
            $table->string('headphone_status')->nullable();
            $table->text('general_notes')->nullable();
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
