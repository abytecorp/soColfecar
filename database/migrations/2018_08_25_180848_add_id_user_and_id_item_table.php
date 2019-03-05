<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdUserAndIdItemTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('changes', function (Blueprint $table) {
            $table->integer('id_user')->unsigned();
            $table->integer('id_item')->unsigned()->nullable();

            $table->foreign('id_user')->references('id')->on('users');
            $table->foreign('id_item')->references('id')->on('items');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('changes', function (Blueprint $table) {
            $table->dropForeign('changes_id_user_foreign');
            $table->dropForeign('changes_id_item_foreign');

            $table->dropColumn('id_user');
            $table->dropColumn('id_item');
        });
    }
}
