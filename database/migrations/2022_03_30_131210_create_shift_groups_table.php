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
        Schema::create('shift_groups', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('company_id');
            $table->unsignedBigInteger('order');
            $table->string('name');
            $table->text('description')->nullable();
            $table->boolean('add_type');
            $table->unsignedTinyInteger('per_day')->nullable();
            $table->boolean('delete_if_exist');
            $table->boolean('week_permit');
            $table->unsignedTinyInteger('number_of_week_permit_day')->nullable();
            $table->boolean('set_group_weekly');
            $table->boolean('sunday_employee_from_shift_group');
            $table->unsignedBigInteger('sunday_employee_from_shift_group_id')->nullable();
            $table->unsignedTinyInteger('friday_additional_break_duration');
            $table->boolean('day0');
            $table->time('day0_start_time');
            $table->time('day0_end_time');
            $table->boolean('day1');
            $table->time('day1_start_time');
            $table->time('day1_end_time');
            $table->boolean('day2');
            $table->time('day2_start_time');
            $table->time('day2_end_time');
            $table->boolean('day3');
            $table->time('day3_start_time');
            $table->time('day3_end_time');
            $table->boolean('day4');
            $table->time('day4_start_time');
            $table->time('day4_end_time');
            $table->boolean('day5');
            $table->time('day5_start_time');
            $table->time('day5_end_time');
            $table->boolean('day6');
            $table->time('day6_start_time');
            $table->time('day6_end_time');
            $table->time('food_break_start');
            $table->time('food_break_end');
            $table->boolean('get_break_while_food_time');
            $table->boolean('get_food_break_without_food_time');
            $table->smallInteger('single_break_duration');
            $table->smallInteger('get_first_break_after_shift_start');
            $table->smallInteger('get_last_break_before_shift_end');
            $table->smallInteger('get_break_after_last_break');
            $table->smallInteger('daily_food_break_amount');
            $table->smallInteger('daily_break_duration');
            $table->smallInteger('daily_food_break_duration');
            $table->smallInteger('daily_break_break_duration');
            $table->smallInteger('momentary_food_break_duration');
            $table->smallInteger('momentary_break_break_duration');
            $table->boolean('suspend_break_using');
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
        Schema::dropIfExists('shift_groups');
    }
};
