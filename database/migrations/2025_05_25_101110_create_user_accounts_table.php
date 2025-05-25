<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('user_accounts', function (Blueprint $table) {
            $table->id();
            $table->string('username')->unique();
            $table->string('password');
            $table->boolean('defaultpassword')->default(true);
            $table->string('role')->default('user');
            $table->timestamp('last_login')->nullable();
            $table->timestamps();
        });

        // Create admin user
        DB::table('user_accounts')->insert([
            'username' => 'admin',
            'password' => Hash::make('admin123'),
            'defaultpassword' => false,
            'role' => 'admin',
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_accounts');
    }
};
