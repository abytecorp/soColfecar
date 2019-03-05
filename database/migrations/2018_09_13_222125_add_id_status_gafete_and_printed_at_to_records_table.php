<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdStatusGafeteAndPrintedAtToRecordsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->dateTime('printed_at')->nullable();
            $table->integer('printed_by')->unsigned()->nullable();
            $table->integer('id_status_gafete')->unsigned()->nullable();

            $table->foreign('printed_by')->references('id')->on('users');
            $table->foreign('id_status_gafete')->references('id')->on('status_gafetes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('records', function (Blueprint $table) {
            $table->dropForeign('records_printed_by_foreign');
            $table->dropForeign('records_id_status_gafete_foreign');

            $table->dropColumn('printed_by');
            $table->dropColumn('id_status_gafete');
        });
    }
}
