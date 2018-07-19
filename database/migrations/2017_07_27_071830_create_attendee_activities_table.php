<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeeActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendee_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('activity_name');
            $table->string('hosted_by');
            $table->string('category');
            $table->string('place');
            $table->string('state');
            $table->string('country')->nullable();
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('participants');
            $table->text('description');
            $table->string('images')->nullable();
            $table->string('videos')->nullable();
            $table->integer('attendee_id')->unsigned();
            $table->integer('venue_id')->unsigned();

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
        Schema::dropIfExists('attendee_activities');
    }
}
