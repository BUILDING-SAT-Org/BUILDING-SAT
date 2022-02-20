<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBsatEnergyTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsat_energy_types', function (Blueprint $table) {
            $table->bigIncrements('key')->index();
            $table->string('id')->index()->nullable();
            $table->json('countries')->nullable();
            $table->string('label');
            $table->smallInteger('year')->nullable();
            $table->string('standard')->nullable();
            $table->string('data_source')->nullable();
            $table->string('technical_specification')->nullable();
            $table->decimal('gwp', 30, 8);
            $table->string('unit')->nullable();
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
        Schema::dropIfExists('bsat_energy_types');
    }
}
