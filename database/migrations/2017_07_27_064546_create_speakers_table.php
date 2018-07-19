<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeakersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speakers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('profession');
            $table->string('age')->nullable();
            $table->string('city');
            $table->string('state');
            $table->string('gender');
            $table->text('address')->nullable();
            $table->string('expert_in')->nullable();
            $table->string('country');
            $table->string('contact');
            $table->string('about');
            $table->string('company_name');
            $table->string('position');
            $table->string('language')->nullable();
            $table->string('recognitions')->nullable();
            $table->string('ventures')->nullable();
            $table->string('exp_in_industry');
            $table->string('awards')->nullable();
            $table->string('events_attended');
            $table->string('profile_image')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('event_id')->unsigned();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('speakers');
    }
}
