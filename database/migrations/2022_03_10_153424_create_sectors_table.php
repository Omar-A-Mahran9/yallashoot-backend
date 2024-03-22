<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSectorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sectors', function (Blueprint $table) {
            $table->id();
            $table->string('name_ar');
            $table->string('name_en');
            $table->string('slug');
            $table->timestamps();
        });

        Schema::create('bank_sector', function (Blueprint $table) {
            $table->primary(['bank_id', 'sector_id']);
            $table->unique(['bank_id', 'sector_id']);
            $table->unsignedBigInteger('bank_id');
            $table->unsignedBigInteger('sector_id');
            $table->float('transferred_benefit')->default(0);
            $table->float('non_transferred_benefit')->default(0);
            $table->float('benefit')->nullable();
            $table->float('support');
            $table->float('advance')->default(0); // اقل مقدم البنك يقبله
            $table->integer('installment')->default(0); // max years for installment
            $table->float('administrative_fees')->default(0);


            $table->foreign('bank_id')
                ->references('id')
                ->on('banks')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');

            $table->foreign('sector_id')
                ->references('id')
                ->on('sectors')
                ->onDelete('NO ACTION')
                ->onUpdate('NO ACTION');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sectors');
    }
}
