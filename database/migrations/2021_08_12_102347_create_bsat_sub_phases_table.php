<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBsatSubPhasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsat_sub_phases', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('main_phase_id')->unsigned()->index();
            $table->string('name');
            $table->string('slug')->nullable();
            $table->tinyInteger('contains_materials')->default(0);
            $table->text('description')->nullable();
            $table->timestamps();
            $table->foreign('main_phase_id')->references('id')->on('bsat_main_phases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bsat_sub_phases');
    }
}
