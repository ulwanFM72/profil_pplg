<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class SetAdminCredentials extends Command
{
    protected $signature = 'admin:credentials {username? : Username baru} {--password= : Password baru (kalau dikosongkan, akan ditanya tersembunyi)}';

    protected $description = 'Mengatur ulang username & password akun admin (membuat akun baru bila belum ada)';

    public function handle(): int
    {
        $username = $this->argument('username') ?: $this->ask('Username baru untuk admin');
        $password = $this->option('password') ?: $this->secret('Password baru untuk admin (input tersembunyi)');

        $validator = Validator::make(compact('username', 'password'), [
            'username' => ['required', 'string', 'min:3', 'max:50', 'alpha_dash'],
            'password' => ['required', 'string', 'min:8'],
        ]);

        if ($validator->fails()) {
            $this->error($validator->errors()->first());

            return self::FAILURE;
        }

        $existing = User::where('username', $username)->first();

        $user = User::updateOrCreate(
            ['id' => optional(User::where('role', 'admin')->first())->id ?? $existing?->id],
            [
                'name' => 'Administrator',
                'username' => $username,
                'email' => $username.'@'.parse_url(config('app.url'), PHP_URL_HOST) ?: $username.'@local.test',
                'password' => Hash::make($password),
                'role' => 'admin',
            ]
        );

        $this->info("Kredensial admin berhasil diperbarui. Username: {$user->username}");

        return self::SUCCESS;
    }
}
