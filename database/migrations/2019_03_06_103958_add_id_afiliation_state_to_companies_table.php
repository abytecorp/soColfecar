<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdAfiliationStateToCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->integer('afiliation_state_id')->unsigned()->nullable();

            $table->foreign('afiliation_state_id')->references('id')->on('afiliation_states');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('companies', function (Blueprint $table) {
            $table->dropForeign('companies_afiliation_state_id_foreign');

            $table->dropColumn('afiliation_state_id');
        });
    }
}
