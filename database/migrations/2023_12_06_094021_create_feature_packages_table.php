<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFeaturePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('feature_packages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('feature_id')->constrained('features')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('package_id')->constrained('packages')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('value');
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
        Schema::dropIfExists('feature_packages');
    }
}
