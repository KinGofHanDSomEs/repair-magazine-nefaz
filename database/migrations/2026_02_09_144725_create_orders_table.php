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
            $table->enum('status', ['Проверяется', 'Оценено', 'Выполняется', 'Завершено', 'Ошибка'])->default('Проверяется');
            $table->integer('price')->nullable();
            $table->enum('payment_status', ['Ожидание', 'Ошибка', 'Успешно'])->default('Ожидание');
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
