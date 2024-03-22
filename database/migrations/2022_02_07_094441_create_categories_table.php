<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('categories', function (Blueprint $table) {

            $table->id();

            $table->string('name_ar');
            $table->string('name_en');

            $table->text('meta_keyword_ar')->nullable();
            $table->text('meta_keyword_en')->nullable();

            $table->text('meta_desc_ar')->nullable();
            $table->text('meta_desc_en')->nullable();

            $table->unsignedBigInteger('car_model_id');
            $table->foreign('car_model_id')
                ->references('id')
                ->on('models')
                ->onUpdate('cascade')
                ->onDelete('cascade');

            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('categories');
    }
}
