<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePhonesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phones', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_phone_type')->unsigned();
            $table->string('number');
            $table->integer('id_user')->unsigned()->nullabe();
            $table->integer('id_company')->unsigned()->nullabe();
            $table->integer('id_assistant')->unsigned()->nullabe();
            $table->integer('id_status')->unsigned()->nullabe();
            $table->timestamps();

            $table->foreign('id_phone_type')->references('id')->on('phone_types');
            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_company')->references('id')->on('companies');
            $table->foreign('id_assistant')->references('id')->on('assistants');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('phones');
    }
}
