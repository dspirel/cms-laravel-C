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
        Schema::create('role_permission', function (Blueprint $table) {
            $table->foreignId('role_id')
                  ->constrained();
            $table->foreignId('permission_id')
                  ->constrained();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Schema::table('role_permission', function (Blueprint $table){
        //     $table->dropForeign('role_id');
        //     $table->dropForeign('permission_id');
        // });
        Schema::dropIfExists('role_permission');
    }
};
