<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->id();
            $table->string("name")->unique();
            $table->boolean('active')
                  ->default(1);
            $table->timestamps();
        });

        DB::table('roles')->insert([
            ['name' => 'user'],
            ['name' => 'admin'],
        ]);
    }

    public function down(): void
    {
        Schema::dropIfExists('roles');
    }
};
