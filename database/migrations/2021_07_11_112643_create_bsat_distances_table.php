<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBsatDistancesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bsat_distances', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('origin_id')->unsigned()->index();
            $table->bigInteger('destination_id')->unsigned()->index();
            $table->float('distance');
            $table->timestamps();
            $table->foreign('origin_id')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('destination_id')->references('id')->on('locations')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bsat_distances');
    }
}
