<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrganisersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organisers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('city');
            $table->string('state');
            $table->string('country');
            $table->string('contact');
            $table->string('address');
            $table->string('gender');
            $table->string('age');
            $table->string('about');
            $table->string('experience');
            $table->string('events_organized');
            $table->string('achievements')->nullable();
            $table->string('company_name');
            $table->string('event_brands');
            $table->string('profile_image')->nullable();
            $table->integer('agency_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('agency_id')->references('id')->on('agencies')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('organisers');
    }
}
