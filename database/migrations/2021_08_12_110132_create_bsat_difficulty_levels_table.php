<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBsatDifficultyLevelsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsat_difficulty_levels', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->bigInteger('sub_phase_id')->unsigned()->index();
            $table->double('difficulty_factor', 30, 5);
            $table->double('bulking_density', 30, 5);
            $table->double('bulking_factor', 30, 5);
            $table->timestamps();
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
        Schema::dropIfExists('bsat_difficulty_levels');
    }
}
