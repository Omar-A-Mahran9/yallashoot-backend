<?php

use App\Enums\VendorStatus;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVendorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vendors', function (Blueprint $table) {
            $table->id();
            $table->string('image')->nullable();
            $table->string('name');

            $table->string('phone')->unique();
            $table->string('another_phone')->nullable();
            // $table->string('address');
            $table->string('status')->default(VendorStatus::pending->value)->comment('App\Enums\VendorStatus');
            $table->enum('type', ['individual','exhibition', 'agency']);
            $table->foreignId('city_id')->references('id')->on('cities')->onDelete('cascade')->onUpdate('cascade');
            $table->foreignId('package_id')->nullable()->references('id')->on('packages')->onDelete('cascade')->onUpdate('cascade');
            $table->string('identity_no')->nullable();
            $table->string('commercial_registration_no')->nullable();
            $table->string('google_maps_url')->nullable();
            $table->string('password');
            $table->string('rejection_reason')->nullable();
            $table->foreignId('created_by')->nullable()->references('id')->on('employees');
            $table->string('verification_code')->nullable();
            $table->timestamp('verified_at')->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('vendors');
    }
}
