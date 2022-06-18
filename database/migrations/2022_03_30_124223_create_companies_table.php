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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('tax_office')->nullable();
            $table->string('tax_number')->nullable();
            $table->string('record_number')->nullable();
            $table->unsignedBigInteger('commercial_company_id')->nullable();
            $table->unsignedBigInteger('uyum_crm_company_id')->nullable();
            $table->unsignedBigInteger('uyum_crm_branch_id')->nullable();
            $table->string('uyum_crm_branch_code')->nullable();
            $table->string('active_year', 4)->nullable();
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
        Schema::dropIfExists('companies');
    }
};
