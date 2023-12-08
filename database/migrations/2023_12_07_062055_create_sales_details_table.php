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
        Schema::create('sales_details', function (Blueprint $table) {
            $table->id();            
            $table->integer('sale_id')->constrained();
            $table->integer('quantity')->default(0);
            $table->unsignedBigInteger('product_branche_id');
            $table->boolean('status')->default(true);
            $table->timestamps();
            
            $table->foreign('product_branche_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sales_details');
    }
};
