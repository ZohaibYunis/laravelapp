<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContestPaymentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contest_payment', function (Blueprint $table) {
            $table->increments('contest_payment_id');
            $table->unsignedInteger('fk_user_id');
            $table->integer('payment_date');
            $table->string('payment_file_path');
            $table->string('contest_reg_end_date');

            $table->foreign('fk_user_id')
                ->references('user_id')->on('users')
                ->onDelete('cascade');
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
        Schema::dropIfExists('contest_payment');
    }
}
