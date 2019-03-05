<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegObservationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reg_observations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_record')->unsigned();
            $table->integer('us_cr')->unsigned();
            $table->longText('obs');
            $table->timestamps();

            $table->foreign('id_record')->references('id')->on('records');
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
        Schema::dropIfExists('reg_observations');
    }
}
