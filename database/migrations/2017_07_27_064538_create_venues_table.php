<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venues', function (Blueprint $table) {
            $table->increments('id');
            $table->string('venue_name');
            $table->string('branch_cities')->nullable();
            $table->text('address');
            $table->text('services');
            $table->text('facilities');
            $table->string('contact');
            $table->text('about');
            $table->string('manager')->nullable();
            $table->string('country')->nullable();
            $table->string('total_eventsHosted');
            $table->string('work_hours');
            $table->string('capacity_of_accomodation')->nullable();
            $table->string('website')->nullable();
            $table->string('mode_of_payment')->nullable();
            $table->string('images')->nullable();
            $table->string('video')->nullable();
            $table->text('near_by_places')->nullable();
            //$table->integer('event_id')->unsigned();
            $table->integer('user_id')->unsigned();

            //$table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('venues');
    }
}
