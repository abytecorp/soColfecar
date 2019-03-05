<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->string('event');
            $table->integer('id_event_type')->unsigned();
            $table->integer('is_billing')->nullable();
            $table->datetime('date_init');
            $table->datetime('date_end');
            $table->string('banner')->nullable();
            $table->integer('id_status')->unsigned()->default(1);
            $table->timestamps();

            $table->foreign('id_event_type')->references('id')->on('event_types');
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
        Schema::dropIfExists('events');
    }
}
