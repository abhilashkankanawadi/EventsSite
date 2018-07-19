<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeakerSessionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speaker_sessions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('event_name');
            $table->string('category')->nullable();;
            $table->string('start_time')->nullable();
            $table->string('end_time')->nullable();
            $table->string('start_date')->nullable();
            $table->string('end_date')->nullable();
            $table->string('highlights')->nullable();
            $table->text('description');
            $table->string('country');
            $table->string('city');
            $table->string('venue');
            $table->integer('venue_id')->unsigned();
            $table->integer('speaker_id')->unsigned();

            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('speaker_sessions');
    }
}
