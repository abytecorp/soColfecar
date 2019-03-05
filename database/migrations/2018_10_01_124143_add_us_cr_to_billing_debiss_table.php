<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUsCrToBillingDebissTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('billing_debits', function (Blueprint $table) {
            $table->integer('us_cr')->unsigned();

            $table->foreign('us_cr')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('billing_debits', function (Blueprint $table) {
            $table->dropForeign('billing_debits_us_cr_foreign');

            $table->dropColumn('us_cr');
        });
    }
}
