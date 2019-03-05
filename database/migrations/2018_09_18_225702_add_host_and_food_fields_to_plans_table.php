<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddHostAndFoodFieldsToPlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('plans', function (Blueprint $table) {
            $table->integer('academic_agenda')->nullable()->default(1);
            $table->integer('lunches')->nullable()->default(3);
            $table->integer('refreshments')->nullable()->default(4);
            $table->integer('dinner')->nullable()->default(3);
            $table->integer('breakfast')->nullable()->default(null);
            $table->integer('host')->nullable()->default(null);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('plans', function (Blueprint $table) {
            //
        });
    }
}
