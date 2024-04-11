<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSatellitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('satellites', function (Blueprint $table) {
            $table->id();
            $table->foreignId('channel_id')->nullable()->constrained('channels')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('frequency');
            $table->string('polarization');
            $table->string('modulation');
            $table->string('correction');
            $table->string('encryption');
            $table->timestamps();
        });

        // Add channels data
        $channels = [
            [
                'name' => 'Channel A',
                'frequency' => '1234 MHz',
                'polarization' => 'Horizontal',
                'modulation' => 'QPSK',
                'correction' => 'Forward Error Correction (FEC)',
                'encryption' => true,
            ],
            [
                'name' => 'Channel B',
                'frequency' => '5678 MHz',
                'polarization' => 'Vertical',
                'modulation' => '8PSK',
                'correction' => 'Low-Density Parity-Check (LDPC)',
                'encryption' => false,
            ],
            // Add more channels as needed
        ];

        foreach ($channels as $channel) {
            DB::table('satellites')->insert($channel);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('satellites');
    }
}
