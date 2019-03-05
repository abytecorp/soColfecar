<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdStatusIdItemToSubItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sub_items', function (Blueprint $table) {
            $table->integer('id_item')->unsigned();
            $table->integer('id_status')->unsigned();

            $table->foreign('id_item')->references('id')->on('items');
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
        Schema::table('sub_items', function (Blueprint $table) {
            $table->dropForeign('sub_items_id_item_foreign');
            $table->dropForeign('sub_items_id_status_foreign');

            $table->dropColumn('id_item');
            $table->dropColumn('id_status');
        });
    }
}
