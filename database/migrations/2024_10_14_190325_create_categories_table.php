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
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('code')->unique();
            $table->boolean('is_active')->default(true);
            $table->softDeletes();
            $table->timestamps();
        });

        DB::table('categories')->insert([
            ['name' => 'Electronics', 'code' => 'CAT001', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Clothing', 'code' => 'CAT002', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Home Appliances', 'code' => 'CAT003', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Books', 'code' => 'CAT004', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Furniture', 'code' => 'CAT005', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Toys', 'code' => 'CAT006', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Sports', 'code' => 'CAT007', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Automotive', 'code' => 'CAT008', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beauty', 'code' => 'CAT009', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Health', 'code' => 'CAT010', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Grocery', 'code' => 'CAT011', 'created_at' => now(), 'updated_at' => now()],
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
