<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRefreshmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('refreshments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('refreshment');
            $table->integer('id_record')->unsigned();
            $table->datetime('claim')->nullable()->default(null);
            $table->timestamps();

            $table->foreign('id_record')->references('id')->on('records');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('refreshments');
    }
}
