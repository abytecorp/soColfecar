<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNoLoadTranspCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('no_load_transp_companies', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned()->nullable();
            $table->longText('services_description')->nullable();
            $table->string('association1')->nullable();
            $table->integer('association1_time')->nullable();
            $table->string('association2')->nullable();
            $table->integer('association2_time')->nullable();
            $table->string('association3')->nullable();
            $table->integer('association3_time')->nullable();
            $table->string('association4')->nullable();
            $table->integer('association4_time')->nullable();
            $table->string('association5')->nullable();
            $table->integer('association5_time')->nullable();
            $table->string('association6')->nullable();
            $table->integer('association6_time')->nullable();
            $table->string('association7')->nullable();
            $table->integer('association7_time')->nullable();
            $table->string('association8')->nullable();
            $table->integer('association8_time')->nullable();
            $table->string('association9')->nullable();
            $table->integer('association9_time')->nullable();
            $table->string('association10')->nullable();
            $table->integer('association10_time')->nullable();
            $table->integer('partners_asociate_another_associations')->nullable();
            $table->longText('paaa_asiciations_desc')->nullable();
            $table->longText('paaa_partners_desc')->nullable();
            $table->integer('us_cr')->unsigned()->nullable();
            $table->integer('status_id')->unsigned()->nullable();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('us_cr')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('no_load_transp_companies');
    }
}
