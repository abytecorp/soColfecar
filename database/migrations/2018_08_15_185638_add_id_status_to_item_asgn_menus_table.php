<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdStatusToItemAsgnMenusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('item_asgn_menus', function (Blueprint $table) {
            $table->integer('id_status')->unsigned();

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
        Schema::table('item_asgn_menus', function (Blueprint $table) {
            $table->dropForeign('item_asgn_menus_id_status_foreign');

            $table->dropColumn('id_status');
        });
    }
}
