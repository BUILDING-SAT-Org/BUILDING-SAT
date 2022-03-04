<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMaterialEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_material_entries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id')->unsigned()->index();
            $table->bigInteger('sub_phase_id')->unsigned()->index();
            $table->tinyInteger('is_new')->default(0);
            $table->tinyInteger('is_updated')->default(0);
            $table->string('material_id')->nullable();
            $table->decimal('total_material_co2e', 30, 8)->nullable();
            $table->double('quantity', 30, 5)->nullable();
            $table->double('total_bulking_quantity', 30, 5)->nullable();
            $table->integer('service_life')->nullable();
            $table->double('wastage', 6, 3)->nullable();
            $table->integer('location_id')->nullable();
            $table->string('other_location')->nullable();
            $table->double('local_distance', 30, 5)->nullable();
            $table->string('local_transport_vehicle_id')->nullable();
            $table->double('overseas_distance', 30, 5)->nullable();
            $table->string('overseas_transport_vehicle_id')->nullable();
            $table->double('total_distance', 30, 5)->nullable();
            $table->decimal('local_transport_co2e', 30, 8)->nullable();
            $table->decimal('overseas_transport_co2e', 30, 8)->nullable();
            $table->decimal('total_transport_co2e', 30, 8)->nullable();
            $table->decimal('total_co2e', 30, 8)->nullable();
            $table->string('total_co2e_label')->nullable();
            $table->integer('no_replacements')->default(0)->nullable();
            $table->decimal('maintenance_material_co2e', 30, 8)->nullable();
            $table->tinyInteger('is_replaceable')->default(0);
            $table->tinyInteger('is_salvage')->default(0);
            $table->json('data')->nullable();
            $table->double('salvage_percentage', 6, 3)->nullable();
            $table->double('landfill_percentage', 6, 3)->nullable();
            $table->decimal('salvage_quantity', 30, 5)->nullable();
            $table->decimal('landfill_quantity', 30, 5)->nullable();
            $table->integer('landfill_location_id')->nullable();
            $table->string('landfill_other_location')->nullable();
            $table->double('landfill_other_location_distance', 30, 5)->nullable();
            $table->double('landfill_distance', 30, 5)->nullable();
            $table->string('landfill_transport_vehicle_id')->nullable();
            $table->decimal('landfill_co2e', 30, 8)->nullable();
            $table->decimal('salvage_co2e', 30, 8)->nullable();
            $table->json('landfill_data')->nullable();
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
        Schema::dropIfExists('user_material_entries');
    }
}
