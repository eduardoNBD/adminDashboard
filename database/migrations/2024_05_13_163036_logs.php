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
        Schema::create('logs', function (Blueprint $table) {
            $table->uuid('id')->primary(); 
            $table->string('action');
            $table->json('detail');
            $table->foreignUuid('user')->nullable()->references('id')->on('users')->onDelete('restrict'); 
            $table->timestamp('created_at');  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('logs', function (Blueprint $table) {
            if (Schema::hasColumn('logs', 'user')) {
                $table->dropForeign(['user']);
            }
        });

        Schema::dropIfExists('logs');
    }
};