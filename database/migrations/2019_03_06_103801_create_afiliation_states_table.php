<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAfiliationStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('afiliation_states', function (Blueprint $table) {
            $table->increments('id');
            $table->string('afiliation_state');
            $table->longText('desc')->nullable();
            $table->integer('status_id')->unsigned();
            $table->integer('user_cr')->unsigned();
            $table->timestamps();

            $table->foreign('status_id')->references('id')->on('status');
            $table->foreign('user_cr')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('afiliation_states');
    }
}
