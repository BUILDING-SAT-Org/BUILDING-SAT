<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMaterialsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_materials', function (Blueprint $table) {
            $table->bigIncrements('key')->index();
            $table->string('id')->index()->nullable();
            $table->bigInteger('project_id')->unsigned()->index();
            $table->bigInteger('category_id')->unsigned()->index();
            $table->json('countries');
            $table->string('label');
            $table->smallInteger('year');
            $table->string('standard')->nullable();
            $table->string('data_source')->nullable();
            $table->double('service_life', 30, 3);
            $table->string('technical_specification')->nullable();
            $table->double('bulking_density', 30, 5);
            $table->double('bulking_factor', 30, 5);
            $table->string('conversion_unit')->nullable();
            $table->decimal('gwp', 30, 8);
            $table->string('unit')->nullable();
            $table->double('wastage', 6, 3);
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
            $table->foreign('category_id')->references('id')->on('bsat_material_categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_materials');
    }
}
