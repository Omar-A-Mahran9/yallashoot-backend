<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNewsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('news', function (Blueprint $table) {
            $table->id();
            $table->string('title_ar');
            $table->string('title_en');
            $table->boolean('highlighted_news')->default(false);
            $table->string('highlighted_image')->nullable();
            $table->string('main_image');
            // $table->string('cover_image')->nullable();
            // $table->longText('tags');
            $table->longText('description_ar');
            $table->longText('description_en');
            // $table->boolean('highlighted')->default(false);
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
        Schema::dropIfExists('news');
    }
}
