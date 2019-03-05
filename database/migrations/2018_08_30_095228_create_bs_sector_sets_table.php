<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBsSectorSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bs_sector_sets', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_bussiness_sector')->unsigned();
            $table->integer('id_status')->unsigned();
            $table->integer('us_cr')->unsigned();
            $table->timestamps();

            $table->foreign('id_bussiness_sector')->references('id')->on('bussiness_sectors');
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
        Schema::dropIfExists('bs_sector_sets');
    }
}
