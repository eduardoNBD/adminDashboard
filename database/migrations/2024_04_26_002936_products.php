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
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->string('key');
            $table->double('price');
            $table->string('image');
            $table->bigInteger('qty'); 
            $table->tinyInteger('status')->default('1');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');   
            $table->foreignUuid('modify_by')->references('id')->on('users')->onDelete('cascade')->nullable();
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





                