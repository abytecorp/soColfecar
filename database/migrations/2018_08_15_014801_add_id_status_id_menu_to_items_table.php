<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdStatusIdMenuToItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('items', function (Blueprint $table) {
            $table->integer('id_menu')->unsigned();
            $table->integer('id_status')->unsigned();

            $table->foreign('id_menu')->references('id')->on('menus');
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
        Schema::table('items', function (Blueprint $table) {
            $table->dropForeign('items_id_menu_foreign');
            $table->dropForeign('items_id_status_foreign');

            $table->dropColumn('id_menu');
            $table->dropColumn('id_status');
        });
    }
}
