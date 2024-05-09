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
        Schema::create('appointments', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->bigInteger('identifier'); 
            $table->foreignUuid('user_id')->nullable()->constrained()->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('modify_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreignUuid('service_id')->nullable()->constrained()->references('id')->on('services')->onDelete('cascade'); 
            $table->foreignUuid('client_id')->nullable()->constrained()->references('id')->on('clients')->onDelete('cascade'); 
            $table->date('date');
            $table->time('begin');
            $table->time('end'); 
            $table->string('notes')->nullable();
            $table->tinyInteger('status')->default('1');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');   
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    { 
        Schema::dropIfExists('appointments');
    }
};



