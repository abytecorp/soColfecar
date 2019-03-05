<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plans', function (Blueprint $table) {
            $table->increments('id');
            $table->string('plan');
            $table->text('pl_desc')->nullable();
            $table->integer('id_event')->unsigned();
            $table->decimal('price')->nullable();
            $table->integer('id_status')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('id_event')->references('id')->on('events');
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
        Schema::dropIfExists('plans');
    }
}
