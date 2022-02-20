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
            $table->bigInteger('location_id')->nullable()->unsigned()->index();
            $table->bigInteger('building_type_id')->unsigned()->index();
            $table->bigInteger('building_form_id')->unsigned()->index();
            $table->string('name');
            $table->string('other_location')->nullable();
            $table->string('image')->nullable();
            $table->integer('building_life_expectancy')->nullable();
            $table->double('building_height')->nullable();
            $table->integer('no_floors')->nullable();
            $table->integer('floors_above_ground')->nullable();
            $table->integer('floors_below_ground')->nullable();
            $table->double('ground_floor_area')->nullable();
            $table->double('building_foot_print')->nullable();
            $table->string('description', 3000)->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('project_type_id')->references('id')->on('bsat_project_types');
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('location_id')->references('id')->on('locations');
            $table->foreign('building_type_id')->references('id')->on('bsat_building_types');
            $table->foreign('building_form_id')->references('id')->on('bsat_building_forms');
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
