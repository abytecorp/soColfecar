<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateHotelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hotels', function (Blueprint $table) {
            $table->increments('id');
            $table->string('hotel_name');
            $table->integer('id_city')->unsigned();
            $table->string('address')->nullable();
            $table->string('email')->nullble();
            $table->string('web')->nullable();
            $table->integer('stars')->nullable();
            $table->integer('id_status')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('id_city')->references('id')->on('cities');
            $table->foreign('id_status')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('hotels');
    }
}
