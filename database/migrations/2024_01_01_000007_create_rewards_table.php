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
        Schema::create('rewards', function (Blueprint $table) {
            $table->id('id_reward');
            $table->unsignedBigInteger('id_task');
            $table->unsignedBigInteger('id_user');
            $table->integer('exp_earned')->default(0);
            $table->integer('coin_earned')->default(0);
            $table->date('reward_date');
            $table->timestamps();

            $table->foreign('id_task')->references('id_task')->on('tasks')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rewards');
    }
};
