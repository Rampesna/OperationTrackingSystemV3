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
        Schema::create('knowledge_base_questions', function (Blueprint $table) {
            $table->id();
            $table->string('creator_type');
            $table->unsignedBigInteger('creator_id');
            $table->unsignedBigInteger('category_id')->nullable();
            $table->text('question')->index();
            $table->longText('answer')->nullable();
            $table->unsignedBigInteger('view_count')->default(0);
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
        Schema::dropIfExists('knowledge_base_questions');
    }
};
