<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDinnersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dinners', function (Blueprint $table) {
            $table->increments('id');
            $table->string('dinner');
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
        Schema::dropIfExists('dinners');
    }
}
