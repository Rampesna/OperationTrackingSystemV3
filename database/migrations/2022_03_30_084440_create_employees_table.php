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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('guid')->nullable();
            $table->bigInteger('company_id')->unsigned();
            $table->bigInteger('role_id')->unsigned();
            $table->bigInteger('job_department_id')->unsigned()->nullable();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->string('identity')->nullable();
            $table->string('image')->nullable();
            $table->string('santral_code')->nullable();
            $table->string('password');
            $table->boolean('leave')->default(0);
            $table->boolean('suspend')->default(0);
            $table->boolean('theme')->default(0);
            $table->boolean('saturday_permit_order');
            $table->boolean('saturday_permit_exemption')->default(0);
            $table->string('api_token')->nullable();
            $table->rememberToken();
            $table->string('device_token')->nullable();
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
        Schema::dropIfExists('employees');
    }
};
