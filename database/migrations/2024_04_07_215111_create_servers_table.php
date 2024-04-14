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
        Schema::create('servers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('description')->nullable();
            $table->string('identifier')->unique()->nullable();
            $table->boolean('suspended')->default(false);
            $table->string('pterodactyl_server_id')->nullable();
            $table->foreignId('product_id')->constrained('products');
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->timestamp('suspended_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('servers');
    }
};
