<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBsatMortarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsat_mortars', function (Blueprint $table) {
            $table->bigIncrements('key')->index();
            $table->string('id')->index()->nullable();
            $table->string('label');
            $table->double('mortar_percentage', 6, 3);
            $table->double('sand_bulking_factor', 30, 5);
            $table->double('sand_bulking_density', 30, 5);
            $table->double('cement_bulking_factor', 30, 5);
            $table->double('cement_bulking_density', 30, 5);
            $table->double('wastage', 6, 3);
            $table->double('service_life', 30, 3)->nullable();
            $table->tinyInteger('is_salvage');
            $table->tinyInteger('is_replaceable');
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
        Schema::dropIfExists('bsat_mortars');
    }
}
