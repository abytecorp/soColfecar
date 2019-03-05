<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChaptersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chapters', function (Blueprint $table) {
            $table->increments('id');
            $table->string('chapter');
            $table->text('description')->nullable();
            $table->integer('id_chapter_type')->nullable()->unsigned();
            $table->integer('is_billing')->nullable();
            $table->datetime('date_init');
            $table->datetime('date_end');
            $table->string('banner')->nullable();
            $table->integer('id_status')->unsigned()->default(1);
            $table->integer('user_id')->unsigned();
            $table->timestamps();

            $table->foreign('id_chapter_type')->references('id')->on('chapter_types');
            $table->foreign('id_status')->references('id')->on('status');
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('chapters');
    }
}
