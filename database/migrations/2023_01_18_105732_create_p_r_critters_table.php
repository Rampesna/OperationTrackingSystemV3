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
        Schema::create('p_r_critters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('p_r_card_id');
            $table->string('column_code')->unique();
            $table->string('name');
            $table->double('min_target');
            $table->double('min_target_percent');
            $table->double('default_target');
            $table->double('default_target_percent');
            $table->double('max_target');
            $table->double('max_target_percent');
            $table->double('general_percent');
            $table->smallInteger('version')->default(1);
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
        Schema::dropIfExists('p_r_critters');
    }
};
