<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAddressesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('addresses', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_city')->unsigned();
            $table->string('adress');
            $table->integer('id_user')->unsigned()->nullabe();
            $table->integer('id_company')->unsigned()->nullabe();
            $table->integer('id_assistant')->unsigned()->nullabe();
            $table->integer('id_status')->unsigned()->nullabe();
            
            $table->timestamps();

            $table->foreign('id_city')->references('id')->on('cities');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_company')->references('id')->on('companies');
            $table->foreign('id_assistant')->references('id')->on('assistants');
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
        Schema::dropIfExists('addresses');
    }
}
