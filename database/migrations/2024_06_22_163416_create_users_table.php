<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 16);
            $table->string('email')->unique();
            $table->string('password');
            $table->foreignId('role_id')
                  ->default(1)
                  ->constrained();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        // Schema::table('users', function (Blueprint $table){
        //     $table->dropForeign('role_id');
        // });
        Schema::dropIfExists('users');
    }
};
