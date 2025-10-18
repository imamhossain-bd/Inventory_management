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
            $table->id();
            $table->string('name');
            $table->string('slug')->unique();
            $table->string('sku')->unique();
            $table->string('barcode')->nullable();
            $table->decimal('purchase_price', 10, 2);
            $table->decimal('selling_price', 10, 2);
            $table->decimal('discount_price', 10, 2)->nullable();
            $table->integer('stock')->default(0);
            $table->integer('stock_alert')->default(10);
            $table->longText('description')->nullable();
            $table->string('thumbnail')->nullable();
            $table->json('images')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');

            // Corrected foreign keys
            $table->foreignId('warranty_id')->constrained('warranties')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('categories')->onDelete('cascade');
            $table->foreignId('brand_id')->nullable()->constrained('brands')->onDelete('set null');
            $table->foreignId('supplier_id')->nullable()->constrained('suppliers')->onDelete('set null');
            $table->foreignId('unit_id')->constrained('units')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
