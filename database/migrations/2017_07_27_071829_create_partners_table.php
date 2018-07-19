<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePartnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('partners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('designation');
            $table->string('company_name');
            $table->string('email');
            $table->text('description');
            $table->string('website');
            $table->string('booth_staff')->nullable();
            $table->text('postalAddress')->nullable();
            $table->string('company_logo')->nullable();
            $table->string('pinCode')->nullable();
            $table->string('phone')->unique();
            $table->string('city')->nullable();
            $table->string('state')->nullable();
            $table->string('country')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('event_id')->unsigned();
            $table->integer('partnership_category_id')->unsigned();

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('partnership_category_id')->references('id')->on('partnership_categories')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('partners');
    }
}
