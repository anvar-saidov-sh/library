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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title')->index();
            $table->foreignId('author_id')->constrained()->cascadeOnDelete();
            $table->string('category')->nullable()->index();
            $table->integer('published_year')->nullable()->index();
            $table->string('isbn')->nullable()->unique();
            $table->enum('status', ['available', 'borrowed'])->default('available')->index();
            $table->unsignedInteger('read_count')->default(0); // for "most read" report
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
