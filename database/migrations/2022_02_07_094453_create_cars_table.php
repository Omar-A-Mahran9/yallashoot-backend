\<?php

use App\Enums\CarStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
             // basic info
            $table->id();
            $table->string('ad_name')->nullable();
            $table->string('name_ar');
            $table->string('name_en');
            $table->decimal('price',14);
            $table->decimal('discount_price',14)->nullable();
            $table->boolean('have_discount')->default(0);
            $table->boolean('is_duplicate')->default(0);
            $table->string('video_url')->nullable();
            $table->foreignId('vendor_id')->nullable()->references('id')->on('vendors')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('city_id')->nullable()->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('brand_id')->nullable()->references('id')->on('brands')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('model_id')->nullable()->references('id')->on('models')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('category_id')->nullable()->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('color_id')->nullable()->references('id')->on('colors')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('kilometers')->nullable(); // for used cars only
            $table->integer('year');
            $table->integer('fuel_tank_capacity')->default(0);

            $table->enum('gear_shifter', ['manual', 'automatic']);
            $table->enum('car_body', ['hatchback', 'sedan', 'four-wheel-drive', 'commercial','family']);
            $table->enum('supplier', ['gulf', 'saudi']); // gulf or saudi
            $table->boolean('is_new')->default(true); // new or used
            $table->text('description_ar');
            $table->text('description_en')->nullable();
            $table->enum('fuel_type', ['gasoline', 'diesel', 'electric', 'hybrid'])->default('gasoline');           
             $table->string('status')->default(CarStatus::pending->value)->comment('App\Enums\CarStatus');
            $table->string('rejection_reason')->nullable();
            $table->boolean('publish')->default(1);
            $table->boolean('show_in_home_page')->default(1);
            $table->longText('main_image')->nullable();

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
        Schema::dropIfExists('cars');
    }
}
