<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContestDateToCatWiseContestStudentStrength extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cat_wise_contest_student_strength', function (Blueprint $table) {
            $table->date('contest_date')->after('total_student_strength');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cat_wise_contest_student_strength', function (Blueprint $table) {
            $table->date('contest_date');
        });
    }
}
