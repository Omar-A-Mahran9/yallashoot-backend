<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderNotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_notifications', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('vendor_id')->nullable();
            $table->foreign('vendor_id')->references('id')->on('vendors')->onDelete('cascade')->onUpdate('cascade');

            $table->unsignedBigInteger('order_id')->nullable();
            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('ad_id')->nullable();
            $table->foreign('ad_id')->references('id')->on('cars')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('newstatue')->nullable();
            $table->foreign('newstatue')->references('id')->on('setting_order_statuses')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('oldstatue')->nullable();
            $table->foreign('oldstatue')->references('id')->on('setting_order_statuses')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('is_read')->default(false); // Updated to use false as a boolean value

            $table->string('type');
            $table->string('phone');


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
        Schema::dropIfExists('order_notifications');
    }
}
