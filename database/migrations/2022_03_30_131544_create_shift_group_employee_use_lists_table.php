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
        Schema::create('shift_group_employee_use_lists', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('shift_group_id');
            $table->unsignedBigInteger('employee_id');
            $table->boolean('used')->default(0);
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
        Schema::dropIfExists('shift_group_employee_use_lists');
    }
};
