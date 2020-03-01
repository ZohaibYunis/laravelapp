<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryWiseContestStudentStrengthTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cat_wise_contest_student_strength', function (Blueprint $table) {
            $table->increments('cat_contest_std_st_id');
            $table->integer('fk_user_id')->unsigned();
            $table->integer('fk_contest_cat_id')->unsigned();
            $table->integer('fk_coordinator_id')->unsigned();
            $table->integer('class_id')->unsigned();
            $table->integer('total_student_strength');

            $table->timestamps();
            $table->foreign('fk_user_id')->references('user_id')->on('users');
            $table->foreign('fk_contest_cat_id')->references('contest_category_id')->on('contest_categories');
            $table->foreign('fk_coordinator_id')->references('coordinator_id')->on('coordinators');
            $table->foreign('class_id')->references('contest_class_id')->on('contest_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('category_wise_contest_student_strength');
    }
}
