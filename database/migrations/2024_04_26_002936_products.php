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
            $table->timestamps(); 
            $table->foreignUuid('modify_by')->nullable()->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            if (Schema::hasColumn('products', 'modify_by')) {
                $table->dropForeign(['modify_by']);
            }
        });

        Schema::dropIfExists('products');
    }
};





                