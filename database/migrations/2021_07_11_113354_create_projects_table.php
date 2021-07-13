<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->unsigned()->index();
            $table->bigInteger('project_type_id')->unsigned()->index();
            $table->bigInteger('country_id')->unsigned()->index();
            $table->bigInteger('location_id')->unsigned()->index();
            $table->bigInteger('building_type_id')->unsigned()->index();
            $table->bigInteger('building_form_id')->unsigned()->index();
            $table->string('name');
            $table->string('image')->nullable();
            $table->integer('building_life_expectancy');
            $table->float('building_height');
            $table->integer('no_floors');
            $table->integer('floors_above_ground');
            $table->integer('floors_below_ground');
            $table->float('ground_floor_area');
            $table->float('building_foot_print');
            $table->string('description',3000);
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_type_id')->references('id')->on('project_types')->onDelete('cascade');
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');
            $table->foreign('location_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('building_type_id')->references('id')->on('building_types')->onDelete('cascade');
            $table->foreign('building_form_id')->references('id')->on('building_forms')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('projects');
    }
}
