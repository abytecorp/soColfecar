<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdStatusIdSubItemToLv3SubItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('lv3_sub_items', function (Blueprint $table) {
            $table->integer('id_sub_item')->unsigned();
            $table->integer('id_status')->unsigned();

            $table->foreign('id_sub_item')->references('id')->on('sub_items');
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
        Schema::table('lv3_sub_items', function (Blueprint $table) {
            $table->dropForeign('lv3_sub_items_id_sub_item_foreign');
            $table->dropForeign('lv3_sub_items_id_status_foreign');

            $table->dropColumn('id_sub_item');
            $table->dropColumn('id_status');
        });
    }
}
