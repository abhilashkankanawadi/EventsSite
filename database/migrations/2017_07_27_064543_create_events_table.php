<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id');
            $table->string('event_name');
            $table->date('start_date');
            $table->date('end_date');
            $table->string('category');
            $table->string('start_time');
            $table->string('end_time');
            $table->string('cost_per_person');
            $table->string('participants')->nullable();
            $table->string('host')->nullable();
            $table->string('langauge');
            $table->text('description');
            $table->string('country');
            $table->string('city');
            $table->string('state');
            $table->string('venue');
            $table->string('contact_mail');
            $table->string('contact_number');
            $table->string('speaker');
            $table->string('guest');
            $table->string('highlights')->nullable();
            $table->string('partner')->nullable();
            $table->string('sponsor')->nullable();
            $table->string('images')->nullable();
            $table->string('video')->nullable();
            $table->integer('organiser_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('venue_id')->unsigned()->nullable();

            $table->foreign('organiser_id')->references('id')->on('organisers')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('venue_id')->references('id')->on('venues')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('events');
    }
}
