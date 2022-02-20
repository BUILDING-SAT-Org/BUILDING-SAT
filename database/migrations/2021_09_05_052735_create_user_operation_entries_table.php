<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserOperationEntriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_operation_entries', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('project_id')->unsigned()->index();
            $table->bigInteger('sub_phase_id')->unsigned()->index();
            $table->tinyInteger('is_new')->default(0);
            $table->tinyInteger('is_updated')->default(0);
            $table->string('material_id')->nullable();
            $table->double('quantity', 30, 5)->nullable();
            $table->decimal('total_co2e', 30, 8)->nullable();
            $table->string('total_co2e_label')->nullable();
            $table->json('data')->nullable();
            $table->timestamps();
            $table->foreign('project_id')->references('id')->on('projects')->onDelete('cascade');
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
        Schema::dropIfExists('user_operation_entries');
    }
}
