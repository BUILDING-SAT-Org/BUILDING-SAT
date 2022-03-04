<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSubPhaseEmissionResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('project_sub_phase_emissions', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id')->unsigned()->index();
            $table->bigInteger('main_phase_id')->unsigned()->index();
            $table->bigInteger('sub_phase_id')->unsigned()->index();
            $table->decimal('material_co2_emission', 30, 8)->default(0)->nullable();
            $table->decimal('machinery_co2_emission', 30, 8)->default(0)->nullable();
            $table->decimal('transport_co2_emission', 30, 8)->default(0)->nullable();
            $table->decimal('total_co2_emission', 30, 8)->default(0)->nullable();
            $table->decimal('energy_co2_emission', 30, 8)->default(0)->nullable();
            $table->decimal('water_co2_emission', 30, 8)->default(0)->nullable();
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('main_phase_id')->references('id')->on('bsat_main_phases');
            $table->foreign('sub_phase_id')->references('id')->on('bsat_sub_phases');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sub_phase_emission_results');
    }
}
