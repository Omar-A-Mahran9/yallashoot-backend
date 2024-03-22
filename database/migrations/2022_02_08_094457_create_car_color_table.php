\<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarColorTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('car_color', function (Blueprint $table) {

            $table->id();

            $table->unsignedBigInteger('car_id');
            $table->unsignedBigInteger('color_id')->nullable();

            $table->longText('inner_images');
            $table->longText('outer_images');


            $table->foreign('car_id')
                ->references('id')
                ->on('cars')->onDelete('cascade');

            $table->foreign('color_id')
                ->references('id')
                ->on('colors')->onDelete('cascade');


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
        Schema::dropIfExists('car_color');
    }
}
