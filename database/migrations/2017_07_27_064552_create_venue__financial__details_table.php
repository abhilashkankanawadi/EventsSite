<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVenueFinancialDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('venue__financial__details', function (Blueprint $table) {
            $table->increments('id');
            $table->string('account_name')->nullable();
            $table->integer('account_number')->nullable()->unsigned();
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('ifsc')->nullable();
            $table->integer('venue_id')->unsigned();

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
        Schema::dropIfExists('venue__financial__details');
    }
}
