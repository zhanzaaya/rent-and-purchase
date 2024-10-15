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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->foreignId('category_id')->constrained('categories');
            $table->text('description');
            $table->decimal('price', 12, 2);
            $table->decimal('hourly_rent_price', 12, 2);
            $table->boolean('is_active')->default(true);
            $table->string('preview_path');
            $table->integer('stock_quantity');
            $table->integer('rental_stock_quantity');
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('products')->insert([
            [
                'name' => 'Product 1',
                'code' => 'PRD001',
                'category_id' => 1,
                'description' => 'Description for Product 1',
                'price' => 19.99,
                'hourly_rent_price' => 4.99,
                'is_active' => true,
                'preview_path' => '/images/product1.png',
                'stock_quantity' => 100,
                'rental_stock_quantity' => 50,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Product 2',
                'code' => 'PRD002',
                'category_id' => 1,
                'description' => 'Description for Product 2',
                'price' => 29.99,
                'hourly_rent_price' => 6.00,
                'is_active' => true,
                'preview_path' => '/images/product2.png',
                'stock_quantity' => 200,
                'rental_stock_quantity' => 25,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Product 3',
                'code' => 'PRD003',
                'category_id' => 2,
                'description' => 'Description for Product 3',
                'price' => 39.99,
                'hourly_rent_price' => 4.00,
                'is_active' => true,
                'preview_path' => '/images/product3.png',
                'stock_quantity' => 150,
                'rental_stock_quantity' => 30,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Product 4',
                'code' => 'PRD004',
                'category_id' => 3,
                'description' => 'Description for Product 4',
                'price' => 49.99,
                'hourly_rent_price' => 8.00,
                'is_active' => true,
                'preview_path' => '/images/product4.png',
                'stock_quantity' => 50,
                'rental_stock_quantity' => 10,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
