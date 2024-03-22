<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars_orders', function (Blueprint $table) {

            $table->id();

            $table->enum('type',['individual','organization']);
            $table->enum('payment_type',['cash','finance']);

            $table->unsignedBigInteger('bank_offer_id')->nullable();
            $table->foreign('bank_offer_id')->references('id')->on('bank_offers')->onDelete('cascade')->onUpdate('cascade');
            
            // cash or finance
            $table->text('cars')->nullable(); // json array [ [ car_id , car_name , count ] , [ car_id , car_name , count ] ]
            $table->string('organization_name')->nullable();
 
            $table->string('commercial_registration_no')->nullable();
            $table->string('organization_email')->nullable();
            $table->unsignedBigInteger('organization_type')->nullable();
            $table->foreign('organization_type')->references('id')->on('organization_types')->onUpdate('cascade');
            
            $table->unsignedBigInteger('organization_activity')->nullable();
            $table->foreign('organization_activity')->references('id')->on('organization_active')->onUpdate('cascade');
            
            $table->string('organization_age')->nullable();
            $table->string('organization_location')->nullable();
            $table->string('transferd_type')->nullable();

            // organization fields

            // individual fields

            // finance
            $table->double('salary')->nullable();
            $table->double('commitments')->nullable();
            $table->boolean('having_loan')->nullable();
            $table->integer('first_installment')->nullable();
            $table->integer('car_count')->nullable();
            $table->integer('last_installment')->nullable();
            $table->integer('installment')->nullable();
            $table->integer('first_payment_value')->nullable();
            $table->integer('last_payment_value')->nullable();
            $table->double('finance_amount')->nullable();
            $table->double('Adminstrative_fees')->nullable();
            $table->double('Monthly_installment')->nullable();



        
            // finance
            $table->enum('driving_license',['available','expired','doesnt_exist'])->nullable();  // both cash or finance
            $table->string('work')->nullable();  // both cash or finance
            // individual fields

            // required in case of ( individual finance & organization finance )
            $table->unsignedBigInteger('order_id')->nullable();
            $table->unsignedBigInteger('bank_id')->nullable();
        

            $table->foreign('order_id')->references('id')->on('orders')->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('bank_id')->references('id')->on('banks')->onUpdate('cascade')->onDelete('cascade');
          
            $table->unsignedBigInteger('sector_id')->nullable();

            $table->foreign('sector_id')
                ->references('id')
                ->on('sectors')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
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
        Schema::dropIfExists('cars_orders');
    }
}
