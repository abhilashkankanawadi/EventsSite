<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSpeakersNotesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('speakers_notes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->nullable();
            $table->text('note')->nullable();
            $table->integer('speaker_id')->unsigned();

            $table->foreign('speaker_id')->references('id')->on('speakers')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('speakers_notes');
    }
}
