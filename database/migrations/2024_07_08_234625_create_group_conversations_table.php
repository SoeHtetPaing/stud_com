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
        Schema::create('group_conversations', function (Blueprint $table) {
            $table->id();
            $table->integer('group_id');
            $table->integer('member_id');
            $table->text('message')->nullable();
            $table->string('attachment')->nullable();
            $table->integer('grade_announce')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('group_conversations');
    }
};
