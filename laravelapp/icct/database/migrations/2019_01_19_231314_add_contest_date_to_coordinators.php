<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddContestDateToCoordinators extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('coordinators', function (Blueprint $table) {
           $table->date('contest_date');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */

        public function down()
    {
        Schema::table('coordinators', function (Blueprint $table) {
            $table->date('contest_date');
        });
    }

}
