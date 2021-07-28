<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserMachinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_machines', function (Blueprint $table) {
            $table->id();
            $table->string('key')->index()->nullable();
            $table->bigInteger('project_id')->unsigned()->index();
            $table->json('countries')->nullable();
            $table->string('label')->nullable();
            $table->integer('year')->nullable();
            $table->string('standard')->nullable();
            $table->string('data_source')->nullable();
            $table->string('technical_specification')->nullable();
            $table->float('gwp');
            $table->string('units')->nullable();
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
        Schema::dropIfExists('user_machines');
    }
}
