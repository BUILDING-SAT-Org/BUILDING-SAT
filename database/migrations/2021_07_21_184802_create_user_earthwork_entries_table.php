<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserEarthworkEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_earthwork_entries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id')->unsigned()->index();
            $table->bigInteger('subphase_id')->unsigned()->index();
            $table->integer('is_new')->default(0);
            $table->integer('is_updated')->default(0);
            $table->integer('quantity')->nullable();
            $table->integer('difficulty_level_id')->nullable();
            $table->integer('machinery_id')->nullable();
            $table->float('machine_hours')->nullable();
            $table->float('machinery_co2e')->nullable();
            $table->string('machinery_co2e_label')->nullable();
            $table->integer('spoil_transported_outside')->nullable();
            $table->float('total_quantity')->nullable();
            $table->integer('spoil_transport_vehicle_id')->nullable();
            $table->integer('location_id')->nullable();
            $table->string('other_location')->nullable();
            $table->float('other_location_distance')->nullable();
            $table->float('total_distance')->nullable();
            $table->float('transport_co2e')->nullable();
            $table->string('transport_co2e_label')->nullable();
            $table->float('total_co2e')->nullable();
            $table->integer('material_id')->nullable();
            $table->float('material_co2_emission')->nullable();
            $table->string('material_co2_label')->nullable();
            $table->integer('wastage')->nullable();
            $table->integer('is_replaceable')->nullable();
            $table->integer('is_salvage')->nullable();
            $table->json('data')->nullable();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('subphase_id')->references('id')->on('bsat_subphases')->onDelete('cascade');
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
        Schema::dropIfExists('user_earthwork_entries');
    }
}
