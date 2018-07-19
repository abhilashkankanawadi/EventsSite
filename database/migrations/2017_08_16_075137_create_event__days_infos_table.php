<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventDaysInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event__days_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date');
            $table->string('start_time');
            $table->string('end_time');
            $table->text('description');
            $table->string('highlights');
            $table->integer('speaker_id')->unsigned()->nullable();
            $table->integer('event_id')->unsigned();
            $table->integer('venue_id')->unsigned();

            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('speaker_id')->references('id')->on('speakers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('event__days_infos');
    }
}
