<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBankOffersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bank_offers', function (Blueprint $table) {
            $table->id();
            $table->string('title_en');
            $table->longText('description_en');
            $table->string('title_ar');
            $table->longText('description_ar');
            $table->string('image');
            $table->date('from');
            $table->date('to');

            $table->unsignedBigInteger('bank_id');
            $table->foreign('bank_id')
                ->references('id')
                ->on('banks')
                ->onUpdate('cascade')
                ->onDelete('cascade');
            
            $table->timestamps();
        });

        Schema::create('bank_offer_brand', function (Blueprint $table) {
            $table->primary(['bank_offer_id', 'brand_id']);
            $table->unique(['bank_offer_id', 'brand_id']);
            $table->unsignedBigInteger('bank_offer_id');
            $table->unsignedBigInteger('brand_id');
           

            $table->foreign('bank_offer_id')
                ->references('id')
                ->on('bank_offers')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');

            $table->foreign('brand_id')
                ->references('id')
                ->on('brands')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });

        Schema::create('bank_offer_sector', function (Blueprint $table) {
            $table->primary(['bank_offer_id', 'sector_id']);
            $table->unique(['bank_offer_id', 'sector_id']);
            $table->unsignedBigInteger('bank_offer_id');
            $table->unsignedBigInteger('sector_id');

            $table->foreign('bank_offer_id')
                ->references('id')
                ->on('bank_offers')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');

            $table->foreign('sector_id')
                ->references('id')
                ->on('sectors')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');

            $table->float('benefit');
            $table->float('support');
            $table->float('advance')->nullable();
            $table->integer('installment')->nullable();
            $table->float('administrative_fees');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bank_offers');
    }
}
