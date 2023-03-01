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
        Schema::create('special_information', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->string('city')->nullable();
            $table->string('current_office')->nullable();
            $table->string('address')->nullable();
            $table->string('working_status')->nullable();
            $table->string('general_status')->nullable();
            $table->string('general_equipment_status')->nullable();
            $table->string('computer_status')->nullable();
            $table->string('internet_status')->nullable();
            $table->string('headphone_status')->nullable();
            $table->date('workable_date')->nullable();
            $table->string('general_notes')->nullable();
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
        Schema::dropIfExists('special_information');
    }
};
