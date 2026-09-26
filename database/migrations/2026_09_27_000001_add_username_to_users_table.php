<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->unique()->nullable()->after('name');
        });

        // Isi username untuk akun yang sudah ada (dari seeder lama), dari bagian sebelum @ di email.
        foreach (\App\Models\User::whereNull('username')->get() as $user) {
            $base = \Illuminate\Support\Str::slug(explode('@', $user->email)[0], '');
            $username = $base ?: 'admin';
            $i = 2;
            while (\App\Models\User::where('username', $username)->where('id', '!=', $user->id)->exists()) {
                $username = $base.$i++;
            }
            $user->update(['username' => $username]);
        }

        Schema::table('users', function (Blueprint $table) {
            $table->string('username')->nullable(false)->change();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('username');
        });
    }
};
