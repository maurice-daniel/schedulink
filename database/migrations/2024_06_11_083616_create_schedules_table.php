<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchedulesTable extends Migration
{
    public function up()
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('faculty_name');
            $table->string('subject');
            $table->string('section');
            $table->string('room');
            $table->time('start_time');
            $table->time('end_time');
            $table->json('days'); // Storing days as JSON array
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('schedules');
    }
}
