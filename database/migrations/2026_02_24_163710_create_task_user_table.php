<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('task_user', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_task');
            $table->unsignedBigInteger('id_user');
            $table->enum('status', ['assigned', 'in_progress', 'submitted', 'completed'])->default('assigned');
            $table->timestamp('completed_at')->nullable();
            $table->timestamps();

            $table->foreign('id_task')->references('id_task')->on('tasks')->onDelete('cascade');
            $table->foreign('id_user')->references('id_user')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('task_user');
    }
};