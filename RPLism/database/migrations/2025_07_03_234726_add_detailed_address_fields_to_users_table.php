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
        Schema::table('users', function (Blueprint $table) {
            // Add detailed address fields
            $table->string('first_name')->nullable()->after('username');
            $table->string('last_name')->nullable()->after('first_name');
            $table->string('street_address')->nullable()->after('address');
            $table->string('city')->nullable()->after('street_address');
            $table->string('state')->nullable()->after('city');
            $table->string('postal_code')->nullable()->after('state');
            $table->string('country')->default('Indonesia')->after('postal_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'first_name',
                'last_name', 
                'street_address',
                'city',
                'state',
                'postal_code',
                'country'
            ]);
        });
    }
};
