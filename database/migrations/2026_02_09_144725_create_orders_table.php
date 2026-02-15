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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->integer('count')->default(1);
            $table->enum('status', ['pending', 'reviewed', 'running', 'completed', 'failed'])->default('pending');
            $table->integer('price')->nullable();
            $table->enum('payment_status', ['pending', 'failed', 'success'])->default('pending');
            $table->string('failed_message')->nullable();
            $table->timestamps();
            $table->dateTime('completed_at')->nullable();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
