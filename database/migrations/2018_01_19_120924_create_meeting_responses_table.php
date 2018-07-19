<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_responses', function (Blueprint $table) {
            $table->increments('id');
            $table->text('message');
            $table->string('time');
            $table->string('meeting_date');
            $table->string('location');
            $table->integer('meeting_request_id')->unsigned();

            $table->foreign('meeting_request_id')->references('id')->on('meeting_requests')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('meeting_responses');
    }
}
