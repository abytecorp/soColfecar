<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdStatusToCompanyStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('company_states', function (Blueprint $table) {
            $table->integer('id_status')->unsigned()->nullable()->default(1);

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
        Schema::table('company_states', function (Blueprint $table) {
            $table->dropForeign('company_states_id_status_foreign');

            $table->dropColumn('id_status');
        });
    }
}
