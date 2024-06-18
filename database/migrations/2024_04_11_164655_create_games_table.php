<?php

use App\Enums\GameStatus;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGamesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('games', function (Blueprint $table) {
            $table->id();
            $table->foreignId('team_one_id')->constrained('teams')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('team_two_id')->constrained('teams')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('league_id')->constrained('leagues')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('playground_id')->constrained('playgrounds')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('country_id')->constrained('countries')->onUpdate('cascade')->onDelete('cascade');
            $table->longText('description_ar');
            $table->longText('description_en');
            $table->date('start_date');
            $table->time('start_time');  
            $table->time('end_time');  

            $table->enum('status', GameStatus::values())->default('pending');
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
        Schema::dropIfExists('games');
    }
}
