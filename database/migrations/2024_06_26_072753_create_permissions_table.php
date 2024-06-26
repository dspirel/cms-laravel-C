<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('permissions', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('description', 512);
        });

        DB::table('permissions')->insert([
            [
            'name' => 'manage_users',
            'description' => 'Create,update,delete,view users.'
            ],
            [
            'name' => 'manage_roles',
            'description' => 'Create,update,delete,view roles.'
            ],
            //TODO - add more permissions for pages and navigation

        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('permissions');
    }
};
