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
        Schema::create('sellings', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->double('subtotal');
            $table->string('notes');
            $table->json('detail');
            $table->foreignUuid('appointment')->references('id')->on('appointments')->onDelete('restrict')->nullable();
            $table->foreignUuid('client')->references('id')->on('users')->onDelete('restrict')->nullable();
            $table->timestamp('created_at');
            $table->timestamp('updated_at');   
            $table->tinyInteger('status')->default('1');
            $table->foreignUuid('modify_by')->references('id')->on('users')->onDelete('restrict')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
