<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdCompanyToBsSectorSetsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('bs_sector_sets', function (Blueprint $table) {
            $table->integer('id_company')->unsigned();

            $table->foreign('id_company')->references('id')->on('companies');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('bs_sector_sets', function (Blueprint $table) {
            $table->dropForeign('bs_sector_sets_id_company_foreign');

            $table->dropColumn('id_company');
        });
    }
}
