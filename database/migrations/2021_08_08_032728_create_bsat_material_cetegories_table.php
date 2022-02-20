<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBsatMaterialCetegoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsat_material_categories', function (Blueprint $table) {
            $table->id();
            $table->string('key')->index()->nullable();
            $table->string('label');
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
        Schema::dropIfExists('bsat_material_cetegories');
    }
}
