<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoLikesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_likes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('like_status')->default(0);
            $table->integer('photo_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->foreign('photo_id')->references('id')->on('photo_feeds')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('photo_likes');
    }
}
