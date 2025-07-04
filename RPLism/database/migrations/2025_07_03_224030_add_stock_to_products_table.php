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
        Schema::table('products', function (Blueprint $table) {
            if (!Schema::hasColumn('products', 'stock')) {
                $table->integer('stock')->default(0)->after('description');
            }
            if (!Schema::hasColumn('products', 'image')) {
                $table->string('image')->nullable()->after('description');
            }
            if (!Schema::hasColumn('products', 'category')) {
                $table->string('category')->nullable()->after('image');
            }
            if (!Schema::hasColumn('products', 'is_featured')) {
                $table->boolean('is_featured')->default(false)->after('stock');
            }
            if (!Schema::hasColumn('products', 'is_active')) {
                $table->boolean('is_active')->default(true)->after('is_featured');
            }
            if (!Schema::hasColumn('products', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn(['stock', 'image', 'category', 'is_featured', 'is_active']);
            if (Schema::hasColumn('products', 'created_at')) {
                $table->dropTimestamps();
            }
        });
    }
};
