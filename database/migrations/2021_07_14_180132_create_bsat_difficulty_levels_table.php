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
            $table->string('difficulty_level');
            $table->bigInteger('bsat_subphase_id')->unsigned()->index();
            $table->float('difficulty_factor');
            $table->float('bulk_density');
            $table->float('bulking_factor');
            $table->timestamps();
            $table->foreign('bsat_subphase_id')->references('id')->on('bsat_subphases')->onDelete('cascade');
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
