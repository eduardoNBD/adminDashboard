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
            $table->bigInteger('no'); 
            $table->foreignUuid('appointment')->nullable()->references('id')->on('appointments')->onDelete('cascade');
            $table->foreignUuid('client')->nullable()->references('id')->on('clients')->onDelete('restrict');
            $table->timestamps();   
            $table->tinyInteger('status')->default('1');
            $table->foreignUuid('modify_by')->nullable()->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sellings', function (Blueprint $table) {
            if (Schema::hasColumn('sellings', 'appointment')) {
                $table->dropForeign(['appointment']);
            }
            if (Schema::hasColumn('sellings', 'client')) {
                $table->dropForeign(['client']);
            }
            if (Schema::hasColumn('sellings', 'modify_by')) {
                $table->dropForeign(['modify_by']);
            }
        });

        Schema::dropIfExists('sellings');
    }
};


