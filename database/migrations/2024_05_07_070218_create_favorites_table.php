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
        Schema::create('favorites', function (Blueprint $table) {
            $table->id('favorite_id');
            $table->unsignedBigInteger('user_number');
            $table->unsignedBigInteger('message_id');
            $table->timestamps();
            
            // 外部キー制約
            $table->foreign('user_number')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('message_id')->references('message_id')->on('board')->onDelete('cascade');

            // user_idとfollow_idの組み合わせの重複を許さない
            $table->unique(['user_number', 'message_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('favorites');
    }
};
