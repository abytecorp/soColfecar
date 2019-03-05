<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBillingCostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('billing_costs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_bill')->unsigned();
            $table->integer('id_types_cost')->unsigned();
            $table->decimal('cost_price');
            $table->string('observation')->nullable();
            $table->timestamps();

            $table->foreign('id_bill')->references('id')->on('bills');
            $table->foreign('id_types_cost')->references('id')->on('billing_types_costs');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('billing_costs');
    }
}
