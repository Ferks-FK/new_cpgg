<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Query\Expression;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('slug')->unique();
            $table->integer('price');
            $table->integer('memory');
            $table->integer('cpu');
            $table->integer('swap');
            $table->integer('disk');
            $table->integer('io');
            $table->integer('databases');
            $table->integer('backups');
            $table->integer('allocations');
            $table->float('minimum_credits')->default(-1);
            $table->boolean('active')->default(true);
            $table->json('eggs')->default(new Expression('(JSON_ARRAY())'));
            $table->json('nodes')->default(new Expression('(JSON_ARRAY())'));
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
