<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRegimeTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regime_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('regime_type');
            $table->integer('us_cr')->unsigned();
            $table->integer('state_id')->unsigned();
            $table->timestamps();

            $table->foreign('us_cr')->references('id')->on('users');
            $table->foreign('state_id')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('regime_types');
    }
}
