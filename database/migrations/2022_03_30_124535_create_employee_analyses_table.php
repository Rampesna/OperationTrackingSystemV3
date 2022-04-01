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
        Schema::create('employee_analyses', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('employee_id');
            $table->date('date');
            $table->boolean('worked');
            $table->smallInteger('incoming_success_call')->unsigned()->nullable();
            $table->smallInteger('incoming_not_answered_call')->unsigned()->nullable();
            $table->smallInteger('outgoing_success_call')->unsigned()->nullable();
            $table->smallInteger('outgoing_not_answered_call')->unsigned()->nullable();
            $table->smallInteger('total_success_call')->unsigned()->nullable();
            $table->time('after_call_work_time')->nullable();
            $table->double('after_call_work_avg_to_minute')->unsigned()->nullable();
            $table->time('ringing_time')->nullable();
            $table->time('hold_time')->nullable();
            $table->time('incoming_call_time')->nullable();
            $table->time('outgoing_call_time')->nullable();
            $table->time('total_talk_time')->nullable();
            $table->double('talk_time_avg_to_minute')->unsigned()->nullable();
            $table->smallInteger('number_of_activities')->unsigned()->nullable();
            $table->smallInteger('number_of_completed_jobs')->unsigned()->nullable();
            $table->smallInteger('used_break_duration')->unsigned()->nullable();
            $table->smallInteger('number_of_answered_chat')->unsigned()->nullable();
            $table->smallInteger('number_of_data_scanning')->unsigned()->nullable();
            $table->smallInteger('number_of_presentation')->unsigned()->nullable();
            $table->smallInteger('number_of_success_opportunity')->unsigned()->nullable();
            $table->smallInteger('number_of_failed_opportunity')->unsigned()->nullable();
            $table->double('call_quality')->unsigned()->nullable();
            $table->double('target_success_rate')->unsigned()->nullable();
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
        Schema::dropIfExists('employee_analyses');
    }
};
