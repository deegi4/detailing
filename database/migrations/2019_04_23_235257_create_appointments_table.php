<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAppointmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appointments', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->timestamp('time');
            $table->string('client');
            $table->string('contact');
            $table->bigInteger('cost');
            $table->tinyInteger('payment_type');
            $table->timestamps();
        });

        Schema::create('appointment_job', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->bigInteger('appointment_id');
            $table->bigInteger('job_id');
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
        Schema::dropIfExists('appointment_job');
        Schema::dropIfExists('appointments');
    }
}
