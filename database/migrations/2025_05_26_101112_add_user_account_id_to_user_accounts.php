<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('user_accounts', function (Blueprint $table) {
            $table->string('user_account_id')->nullable();
        });

        // Update existing user accounts with student IDs
        $students = DB::table('students')->get();
        foreach ($students as $student) {
            DB::table('user_accounts')
                ->where('username', $student->email)
                ->update(['user_account_id' => $student->studentid]);
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_accounts', function (Blueprint $table) {
            $table->dropColumn('user_account_id');
        });
    }
}; 