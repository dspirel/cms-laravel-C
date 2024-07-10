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
        Schema::create('page_categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('title', 32);
            $table->text('text_content');
            $table->string('image')->nullable();
            $table->foreignId('created_by')->constrained(
                table: 'users', indexName: 'pages_user_id'
            );
            $table->foreignId('category_id')->constrained(
                table: 'page_categories', indexName: 'pages_category_id'
            );
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('page_categories');
        Schema::dropIfExists('pages');
    }
};
