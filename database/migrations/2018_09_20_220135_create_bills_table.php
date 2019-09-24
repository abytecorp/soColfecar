<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bills', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_record')->unsigned();
            $table->string('bill_number')->nullable();
            $table->decimal('price');
            $table->boolean('purchase_order')->default(false);
            $table->date('close_date')->nullable();
            $table->string('way_to_pay')->nullable();
            $table->integer('us_cr')->unsigned();
            $table->integer('us_up')->unsigned()->nullable();
            $table->longText('obs')->nullable();
            $table->timestamps();

            $table->foreign('id_record')->references('id')->on('records');
            $table->foreign('us_cr')->references('id')->on('users');
            $table->foreign('us_up')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bills');
    }
}
