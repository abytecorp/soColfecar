<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLegalRepresentativesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('legal_representatives', function (Blueprint $table) {
            $table->increments('id');
            $table->string('names');
            $table->string('last_names');
            $table->integer('type_id_id')->unsigned()->nullable();
            $table->string('number_id');
            $table->integer('expedition_city_id')->unsigned()->nullable();
            $table->string('nationality')->nullable();
            $table->string('profession')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('cellphone')->nullable();
            $table->string('mail')->nullable();
            $table->integer('us_cr')->unsigned();

            $table->timestamps();

            $table->foreign('type_id_id')->references('id')->on('id_types');
            $table->foreign('expedition_city_id')->references('id')->on('cities');
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
        Schema::dropIfExists('legal_representatives');
    }
}
