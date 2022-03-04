<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMortarEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_mortar_entries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id')->unsigned()->index();
            $table->bigInteger('sub_phase_id')->unsigned()->index();
            $table->tinyInteger('is_new')->default(0);
            $table->tinyInteger('is_updated')->default(0);
            $table->string('mortar_id')->nullable();
            $table->double('area', 30, 5)->nullable();
            $table->double('thickness', 30, 5)->nullable();
            $table->tinyInteger('service_life')->nullable();
            $table->double('wastage', 6, 3)->nullable();
            $table->integer('sand_resource_location_id')->nullable();
            $table->string('sand_resource_other_location')->nullable();
            $table->double('sand_transport_distance', 30, 5)->nullable();
            $table->string('sand_transport_vehicle_id')->nullable();
            $table->integer('cement_resource_location_id')->nullable();
            $table->string('cement_resource_other_location')->nullable();
            $table->double('cement_transport_distance', 30, 5)->nullable();
            $table->string('cement_transport_vehicle_id')->nullable();
            $table->double('sand_bulking_quantity', 30, 5)->nullable();
            $table->double('cement_bulking_quantity', 30, 5)->nullable();
            $table->decimal('sand_co2e', 30, 8)->nullable();
            $table->decimal('cement_co2e', 30, 8)->nullable();
            $table->decimal('sand_transport_co2e', 30, 8)->nullable();
            $table->decimal('cement_transport_co2e', 30, 8)->nullable();
            $table->decimal('total_material_co2e', 30, 8)->nullable();
            $table->decimal('total_transport_co2e', 30, 8)->nullable();
            $table->decimal('total_co2e', 30, 8)->nullable();
            $table->string('total_co2e_label')->nullable();
            $table->tinyInteger('is_replaceable')->default(0);
            $table->tinyInteger('is_salvage')->default(0);
            $table->json('data')->nullable();
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('sub_phase_id')->references('id')->on('bsat_sub_phases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_mortar_entries');
    }
}
