<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBrandsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('brands', function (Blueprint $table) {

            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('image');
            $table->string('cover');

            $table->enum('car_available_types', ['new', 'used', 'both'])->nullable()->default(null);

            $table->text('meta_keyword_ar')->nullable();
            $table->text('meta_keyword_en')->nullable();

            $table->text('meta_desc_en')->nullable();
            $table->text('meta_desc_ar')->nullable();

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
        Schema::dropIfExists('brands');
    }
}
