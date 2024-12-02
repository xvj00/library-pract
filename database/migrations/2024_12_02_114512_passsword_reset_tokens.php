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
        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->id(); // Уникальный идентификатор
            $table->string('email')->index(); // Email пользователя
            $table->string('token'); // Токен для сброса пароля
            $table->timestamp('created_at')->nullable(); // Время создания токена
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
