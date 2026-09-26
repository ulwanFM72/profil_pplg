<?php

use App\Models\User;
use Illuminate\Support\Facades\RateLimiter;

test('halaman login admin dapat diakses', function () {
    $this->get(route('admin.login'))->assertOk();
});

test('login gagal dengan password salah', function () {
    $user = User::factory()->create(['email' => 'admin@smk.test']);

    $this->post(route('admin.login.store'), [
        'email' => 'admin@smk.test', 'password' => 'salah-sekali',
    ])->assertSessionHasErrors('email');

    $this->assertGuest();
});

test('login berhasil mengarah ke dashboard', function () {
    $user = User::factory()->create(['email' => 'admin@smk.test', 'password' => bcrypt('password123')]);

    $this->post(route('admin.login.store'), [
        'email' => 'admin@smk.test', 'password' => 'password123',
    ])->assertRedirect(route('admin.dashboard'));

    $this->assertAuthenticatedAs($user);
});

test('percobaan login gagal berulang kali dibatasi (rate limit)', function () {
    RateLimiter::clear('admin@smk.test|127.0.0.1');
    User::factory()->create(['email' => 'admin@smk.test']);

    for ($i = 0; $i < 5; $i++) {
        $this->post(route('admin.login.store'), ['email' => 'admin@smk.test', 'password' => 'salah']);
    }

    $response = $this->post(route('admin.login.store'), ['email' => 'admin@smk.test', 'password' => 'salah']);

    $response->assertSessionHasErrors('email');
    expect(session('errors')->first('email'))->toContain('Terlalu banyak percobaan');
});

test('tamu tidak bisa membuka dashboard dan diarahkan ke login', function () {
    $this->get(route('admin.dashboard'))->assertRedirect(route('admin.login'));
});

test('admin dapat logout', function () {
    $this->actingAs(User::factory()->create());

    $this->post(route('admin.logout'))->assertRedirect(route('admin.login'));
    $this->assertGuest();
});
