<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMeetingRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meeting_requests', function (Blueprint $table) {
            $table->increments('id');
            $table->text('meeting_purpose');
            $table->string('time');
            $table->string('location');
            $table->string('meeting_date');
            $table->integer('event_id')->unsigned();
            $table->integer('request_to')->unsigned();
            $table->integer('requested_by')->unsigned();
            $table->string('requested_date');
            $table->integer('request_status')->unsigned()->default(0);
            $table->integer('organiser_review')->unsigned()->default(0);
            $table->integer('deligateAccept_status')->unsigned()->default(0);

            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('request_to')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('requested_by')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->softDeletes();
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
        Schema::dropIfExists('meeting_requests');
    }
}
