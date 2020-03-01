<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_categories', function (Blueprint $table) {
            $table->increments('contest_category_id');
            $table->string('contest_category_name',255);
            $table->date('contest_registration_start_date');
            $table->date('contest_registration_end_date');
            $table->dateTime('contest_date');
            $table->string('status',64);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('contest_categories');
    }
}
