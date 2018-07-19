<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAgenciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('agencies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('agency_name');
            $table->string('country');
            $table->string('contact');
            $table->string('about');
            $table->integer('events_organised');
            $table->text('services')->nullable();
            $table->string('recognitions')->nullable();
            $table->string('working_hours')->nullable();
            $table->string('working_days');
            $table->string('established')->nullable();
            $table->string('founder')->nullable();
            $table->string('main_branch')->nullable();
            $table->string('address');
            $table->string('sub_branches_cities')->nullable();
            $table->string('website');
            $table->string('images')->nullable();
            $table->integer('user_id')->unsigned();

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
        Schema::dropIfExists('agencies');
    }
}
