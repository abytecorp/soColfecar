<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsToHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms_to_hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_record')->unsigned();
            $table->integer('id_room')->unsigned();
            $table->timestamps();


            $table->foreign('id_record')->references('id')->on('records');
            $table->foreign('id_room')->references('id')->on('rooms');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms_to_hotels');
    }
}
