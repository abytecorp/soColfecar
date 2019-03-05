<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdUserTypeToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->integer('id_user_type')->unsigned();
            $table->integer('id_status')->unsigned()->nullable()->default(1);

            $table->foreign('id_user_type')->references('id')->on('user_types');
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
        Schema::table('users', function (Blueprint $table) {
            $table->dropForeign('users_id_user_type_foreign');
            $table->dropForeign('users_id_status_foreign');

            $table->dropColumn('id_user_type');
            $table->dropColumn('id_status');
        });
    }
}
