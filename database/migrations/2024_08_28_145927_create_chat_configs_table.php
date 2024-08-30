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
        Schema::create('chat_configs', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id');
            $table->integer('mynew')->default(0);
            $table->integer('yrnew')->default(0);
            $table->integer('is_active');
            $table->timestamp('lat');
            $table->integer('creater_id');
            $table->integer('group_id');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chat_configs');
    }
};
