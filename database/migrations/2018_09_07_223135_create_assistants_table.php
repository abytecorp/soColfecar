<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAssistantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('assistants', function (Blueprint $table) {
            $table->increments('id');
            $table->string('names');
            $table->string('last_names');
            $table->integer('id_type')->nullable()->unsigned();
            $table->string('id_number')->nullable();
            $table->integer('id_city')->unsigned()->nullable();
            $table->string('address')->nullable();
            $table->string('position')->nullable();
            $table->string('email')->unique();
            $table->integer('id_company')->unsigned()->nullable();
            $table->integer('id_status')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('id_type')->references('id')->on('id_types');
            $table->foreign('id_city')->references('id')->on('cities');
            $table->foreign('id_company')->references('id')->on('companies');
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
        Schema::dropIfExists('assistants');
    }
}
