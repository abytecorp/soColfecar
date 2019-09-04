<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCargoTransportCompaniesSpecificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cargo_transport_companies_specifications', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('company_id')->unsigned();
            $table->string('resolution_number')->nullable();
            $table->date('res_granted_date')->nullable();
            $table->date('res_expiration_date')->nullable();
            $table->integer('container_or_masive')->nullable();
            $table->integer('postal')->nullable();
            $table->integer('package')->nullable();
            $table->integer('medicines')->nullable();
            $table->integer('bulk')->nullable();
            $table->integer('foods')->nullable();
            $table->integer('danger_matter_no_hydrocarbons_and_else')->nullable();
            $table->integer('customs_transit_dta')->nullable();
            $table->integer('customs_transit_otm')->nullable();
            $table->integer('extralong_and_estranged')->nullable();
            $table->integer('hydrocarbons_and_else')->nullable();
            $table->integer('another1')->nullable();
            $table->string('another1_desc')->nullble();
            $table->integer('another2')->nullable();
            $table->string('another2_desc')->nullble();
            $table->integer('another3')->nullable();
            $table->string('another3_desc')->nullble();
            $table->integer('another4')->nullable();
            $table->string('another4_desc')->nullble();
            $table->longText('add_logistic_services_description')->nullable();
            $table->integer('auto_park_own')->nullable();
            $table->integer('auto_park_society')->nullable();
            $table->integer('auto_park_partners')->nullable();
            $table->integer('auto_park_special_team')->nullable();
            $table->integer('move_ton_prev_year')->nullable();
            $table->integer('move_ton_current_year')->nullable();
            $table->integer('move_ton_next_year')->nullable();
            $table->longText('move_ton_new_lines')->nullable();
            $table->integer('third_pay_travel_system_advance')->nullable();
            $table->integer('third_pay_travel_system_balance')->nullable();
            $table->string('third_pay_travel_system_another')->nullable();
            $table->string('payment_client_system')->nullable();
            $table->longText('obs_payment_client_system')->nullable();
            $table->integer('load_secure_bounty')->nullable();
            $table->integer('load_secure_clients_share')->nullable();
            $table->integer('load_secure_drivers_share')->nullable();
            $table->longText('load_secure_obs')->nullable();
            $table->string('staff_operative')->nullable();
            $table->string('staff_drivers')->nullable();
            $table->string('staff_admin')->nullable();
            $table->string('staff_others')->nullable();
            $table->longText('staff_others_desc')->nullable();
            $table->boolean('staff_social_security')->nullable();
            $table->string('staff_arl')->nullable();
            $table->string('staff_conmpensation_box')->nullable();
            $table->string('phase_sgss')->nullable();
            $table->integer('us_cr')->nullable()->unsigned();
            $table->integer('status_id')->nullable()->unsigned();
            $table->timestamps();

            $table->foreign('company_id')->references('id')->on('companies');
            $table->foreign('us_cr')->references('id')->on('users');
            $table->foreign('status_id')->references('id')->on('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cargo_transport_companies_specifications');
    }
}
