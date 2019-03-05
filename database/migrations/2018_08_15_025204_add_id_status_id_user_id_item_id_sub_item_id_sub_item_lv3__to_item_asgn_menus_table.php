<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdStatusIdUserIdItemIdSubItemIdSubItemLv3ToItemAsgnMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_asgn_menus', function (Blueprint $table) {
            $table->integer('id_user')->unsigned();
            $table->integer('id_item')->unsigned()->nullable();
            $table->integer('id_sub_item')->unsigned()->nullable();
            $table->integer('id_sub_item_lv3')->unsigned()->nullable();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_item')->references('id')->on('items');
            $table->foreign('id_sub_item')->references('id')->on('sub_items');
            $table->foreign('id_sub_item_lv3')->references('id')->on('lv3_sub_items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('item_asgn_menus', function (Blueprint $table) {
            $table->dropForeign('item_asgn_menus_id_user_foreign');
            $table->dropForeign('item_asgn_menus_id_item_foreign');
            $table->dropForeign('item_asgn_menus_id_sub_item_foreign');
            $table->dropForeign('item_asgn_menus_id_sub_item_lv3_foreign');

            $table->dropColumn('id_user');
            $table->dropColumn('id_item');
            $table->dropColumn('id_sub_item');
            $table->dropColumn('id_sub_item_lv3');
        });
    }
}
