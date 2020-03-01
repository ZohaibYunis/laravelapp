<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('user_id');
            $table->integer('fk_role_id')->unsigned();
            $table->string('institute_head',255);
            $table->string('email')->unique();
            $table->string('password');
            $table->rememberToken();
            $table->string('institute_name',255);
            $table->string('institute_province',255);
            $table->string('institute_city',255);
            $table->string('institute_phone',255);
            $table->string('institute_address',1022);
            $table->string('institute_email');

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
        Schema::dropIfExists('users');
    }
}
