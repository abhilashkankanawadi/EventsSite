<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhotoCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('photo_comments', function (Blueprint $table) {
            $table->increments('id');
            $table->text('comments')->nullable();
            $table->string('date')->nullable();
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
        Schema::dropIfExists('photo_comments');
    }
}
