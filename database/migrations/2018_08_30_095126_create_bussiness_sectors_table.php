<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBussinessSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bussiness_sectors', function (Blueprint $table) {
            $table->increments('id');
            $table->string('bussiness_sector');
            $table->integer('id_status')->unsigned();
            $table->integer('us_cr')->unsigned();
            $table->timestamps();

            $table->foreign('id_status')->references('id')->on('status');
            $table->foreign('us_cr')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bussiness_sectors');
    }
}
