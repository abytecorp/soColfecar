<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSocietyKindsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('society_kinds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->date('constitution_date')->nullable();
            $table->string('authorized_social_capital')->nullable();
            $table->decimal('auth_social_capital')->nullable();
            $table->decimal('subs_and_paid_capital')->nullable();
            $table->string('society_kind')->nullable();
            $table->string('another_company_type')->nullable();
            $table->string('eco_activity')->nullable();
            $table->integer('regime_type_id')->nullable()->unsigned();
            
            $table->string('self_retainer_res')->nullable();
            $table->date('self_retainer_res_date')->nullable();

            $table->string('big_contributor_res')->nullable();
            $table->date('big_contributor_res_date')->nullable();

            $table->string('retention_res')->nullable();
            $table->date('retention_res_date')->nullable();
            $table->string('ciiu_code')->nullable();
            $table->string('society_validity')->nullable();
            $table->integer('us_cr')->unsigned();
            $table->integer('status_id')->unsigned()->default(1);

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('us_cr')->references('id')->on('users');
            $table->foreign('regime_type_id')->references('id')->on('regime_types');
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
        Schema::dropIfExists('society_kinds');
    }
}
