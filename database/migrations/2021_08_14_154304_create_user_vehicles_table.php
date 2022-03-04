<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserVehiclesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_vehicles', function (Blueprint $table) {
            $table->bigIncrements('key')->index();
            $table->string('id')->index()->nullable();
            $table->bigInteger('project_id')->unsigned()->index();
            $table->json('countries');
            $table->string('label');
            $table->smallInteger('year')->nullable();
            $table->string('standard')->nullable();
            $table->string('data_source')->nullable();
            $table->double('loading_capacity', 30, 3);
            $table->string('technical_specification')->nullable();
            $table->decimal('gwp', 30, 8);
            $table->string('unit')->nullable();
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_vehicles');
    }
}
