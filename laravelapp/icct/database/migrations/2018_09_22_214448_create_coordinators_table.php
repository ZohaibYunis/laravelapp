<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCoordinatorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('coordinators', function (Blueprint $table) {
            $table->increments('coordinator_id');
            $table->integer('fk_user_id')->unsigned();
            $table->integer('fk_contest_category_id')->unsigned();
            $table->string('coordinator_name',255);
            $table->string('coordinator_job_title',255);
            $table->string('coordinator_mobile',130);
            $table->string('coordinator_landline',130);
            $table->string('coordinator_email');

            $table->timestamps();

            $table->foreign('fk_user_id')->references('user_id')->on('users');

            $table->foreign('fk_contest_category_id')->references('contest_category_id')->on('contest_categories');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('coordinators');
    }
}
