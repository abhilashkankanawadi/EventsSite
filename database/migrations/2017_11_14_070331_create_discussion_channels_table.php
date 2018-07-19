<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDiscussionChannelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discussion_channels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('channel_info')->nullable();
            $table->string('images')->nullable();
            $table->integer('max_participants')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->integer('user_id')->unsigned()->nullable();

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
        Schema::dropIfExists('discussion_channels');
    }
}
