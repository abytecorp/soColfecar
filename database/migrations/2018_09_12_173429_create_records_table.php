<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('records', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_assistant')->unsigned();
            $table->integer('id_event')->unsigned();
            $table->integer('id_plan')->unsigned();
            $table->timestamps();

            $table->foreign('id_assistant')->references('id')->on('assistants');
            $table->foreign('id_event')->references('id')->on('events');
            $table->foreign('id_plan')->references('id')->on('plans');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('records');
    }
}
