<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserWasteGeneratedEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_waste_generated_entries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id')->unsigned()->index();
            $table->bigInteger('sub_phase_id')->unsigned()->index();
            $table->tinyInteger('is_new')->default(0);
            $table->tinyInteger('is_updated')->default(0);
            $table->string('material_id')->nullable();
            $table->double('quantity', 30, 5)->nullable();
            $table->double('total_bulking_quantity', 30, 5)->nullable();
            $table->integer('location_id')->nullable();
            $table->double('total_distance', 30, 5)->nullable();
            $table->string('other_location')->nullable();
            $table->double('other_location_distance', 30, 5)->nullable();
            $table->string('waste_transport_vehicle_id')->nullable();
            $table->decimal('transport_co2e', 30, 8)->nullable();
            $table->decimal('material_co2e', 30, 8)->nullable();
            $table->decimal('total_co2e', 30, 8)->nullable();
            $table->string('total_co2e_label')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::dropIfExists('user_waste_generated_entries');
    }
}
