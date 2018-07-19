<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAttendeesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attendees', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('how_you_heardabout_event');
            $table->string('company');
            $table->string('position');
            $table->string('gender');
            $table->string('contact');
            $table->integer('age')->nullable();
            $table->text('about')->nullable();
            $table->string('profession')->nullable();
            $table->string('expert_in')->nullable();
            $table->binary('profile_image')->nullable();
            $table->integer('event_id')->unsigned();
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('attendees');
    }
}
