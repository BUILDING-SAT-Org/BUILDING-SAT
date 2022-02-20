<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBsatWasteTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsat_waste_types', function (Blueprint $table) {
            $table->bigIncrements('key')->index();
            $table->string('id')->index()->nullable();
            $table->json('countries')->nullable();
            $table->string('label');
            $table->smallInteger('year')->nullable();
            $table->string('standard')->nullable();
            $table->string('data_source')->nullable();
            $table->string('technical_specification')->nullable();
            $table->double('bulking_density', 30, 5)->nullable();
            $table->double('bulking_factor', 30, 5)->nullable();
            $table->string('conversion_unit')->nullable();
            $table->decimal('gwp', 30, 8);
            $table->string('unit')->nullable();
            $table->double('wastage', 6, 3)->nullable();
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
        Schema::dropIfExists('bsat_waste_types');
    }
}
