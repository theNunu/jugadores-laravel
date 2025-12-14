<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('competition_player', function (Blueprint $table) {
            $table->id();
            $table->uuid('player_id');
            $table->uuid('competition_id');


            $table->foreign('player_id')->references('player_id')->on('players')->cascadeOnDelete();
            $table->foreign('competition_id')->references('competition_id')->on('competitions')->cascadeOnDelete();
            // $table->id();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competition_player');
    }
};
