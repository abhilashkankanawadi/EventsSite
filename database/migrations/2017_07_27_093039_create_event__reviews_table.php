<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('event__reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('review')->nullable();
            $table->integer('speaker');
            $table->integer('crowd');
            $table->integer('event_id')->unsigned();
            $table->integer('attendee_id')->unsigned();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('attendee_id')->references('id')->on('attendees')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('event__reviews');
    }
}
