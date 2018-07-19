<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExhibitorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exhibitors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('representative');
            $table->string('exhibiting_product');
            $table->string('products');
            $table->string('contact');
            $table->string('company_email');
            $table->string('company')->nullable();
            $table->text('about_company')->nullable();
            $table->string('city')->nullable();
            $table->integer('total_employees')->nullable();
            $table->string('branch_cities')->nullable();
            $table->string('founder')->nullable();
            $table->string('address')->nullable();
            $table->string('website')->nullable();
            $table->string('exhibition_attended')->nullable();
            $table->string('established')->nullable();
            $table->string('images')->nullable();
            $table->string('video')->nullable();
            $table->integer('event_id')->unsigned()->nullable();
            $table->integer('user_id')->unsigned();

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
        Schema::dropIfExists('exhibitors');
    }
}
