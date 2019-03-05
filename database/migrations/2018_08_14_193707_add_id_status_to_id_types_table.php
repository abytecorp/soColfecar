<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdStatusToIdTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('id_types', function (Blueprint $table) {
            $table->integer('id_status')->unsigned();

            $table->foreign('id_status')->references('id')->on('status')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('id_types', function (Blueprint $table) {
            $table->dropForeign('id_types_id_status_foreign');

            $table->dropColumn('id_status');
        });
    }
}
