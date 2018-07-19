<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenueReviewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venue__reviews', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('review');
            $table->integer('food')->nullable();
            $table->integer('beverage')->nullable();
            $table->integer('ambience')->nullable();
            $table->integer('service')->nullable();
            $table->integer('crowd')->nullable();
            $table->integer('attendee_id')->unsigned();
            $table->integer('venue_id')->unsigned();
            $table->integer('event_id')->unsigned();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('venue__reviews');
    }
}
