<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoomsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rooms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_room_type')->unsigned()->nullable()->default(null);
            $table->integer('id_hotel')->unsigned();
            $table->integer('room_number');
            $table->timestamps();

            $table->foreign('id_room_type')->references('id')->on('room_types');
            $table->foreign('id_hotel')->references('id')->on('hotels');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rooms');
    }
}
