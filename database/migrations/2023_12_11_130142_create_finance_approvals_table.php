<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFinanceApprovalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('finance_approvals', function (Blueprint $table) {
            $table->id();
            $table->date('approval_date');
            $table->decimal('approval_amount', 20, 2);    
            $table->decimal('tax_discount', 20, 2);
            $table->decimal('discount_percent', 20, 2);
            $table->decimal('discount_amount', 20, 2);
            $table->decimal('cashback_percent', 20, 2);
            $table->decimal('cashback_amount', 20, 2);
            $table->decimal('Main_car_cost', 20, 2);

            $table->decimal('cost', 20, 2);
            $table->decimal('plate_no_cost', 20, 2);
            $table->decimal('insurance_cost', 20, 2);
            $table->decimal('delivery_cost', 20, 2);
            $table->decimal('commission', 20, 2)->nullable();
            $table->decimal('profit', 20, 2);
            $table->text('extra_details')->nullable();
            $table->foreignId('delegate_id')->constrained('delegates')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('order_id')->constrained('orders')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('finance_approvals');
    }
}
