<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestStudentInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_student_info', function (Blueprint $table) {
            $table->increments('contest_student_info_id');
            $table->integer('fk_user_id')->unsigned();
            $table->integer('fk_cat_contest_std_st_id')->unsigned();
            $table->integer('fk_class_id')->unsigned();
            $table->string('student_name',255);
            $table->string('father_name');
            $table->string('fathers_mobile');
            $table->string('registration_status');
            $table->string('status');
            $table->date('registration_last_date')->nullable();
            $table->timestamps();

            $table->foreign('fk_user_id')->references('user_id')->on('users');
            $table->foreign('fk_cat_contest_std_st_id')->references('cat_contest_std_st_id')->on('cat_wise_contest_student_strength');
            $table->foreign('fk_class_id')->references('contest_class_id')->on('contest_classes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest_student_info');
    }
}
