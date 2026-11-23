<?php

use App\Models\User;

test('login screen can be rendered', function () {
    $response = $this->get('/login');

    $response->assertStatus(200);
});

test('users can authenticate using the login screen', function () {
    $user = User::factory()->create();

    $response = $this->post('/login', [
        'email' => $user->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticated();
    $response->assertRedirect(route('dashboardUser', absolute: false));
});

test('admins are redirected to the admin dashboard after login', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $response = $this->post('/login', [
        'email' => $admin->email,
        'password' => 'password',
    ]);

    $this->assertAuthenticatedAs($admin);
    $response->assertRedirect(route('dashboard', absolute: false));
});

test('customers are redirected to their dashboard and cannot access the admin dashboard', function () {
    $customer = User::factory()->create(['role' => 'pelanggan']);

    $this->actingAs($customer)
        ->get(route('dashboard', absolute: false))
        ->assertRedirect(route('dashboardUser', absolute: false));

    $this->get(route('dashboardUser', absolute: false))->assertOk();
});

test('admins cannot access the customer dashboard', function () {
    $admin = User::factory()->create(['role' => 'admin']);

    $this->actingAs($admin)
        ->get(route('dashboardUser', absolute: false))
        ->assertForbidden()
        ->assertSee('Anda tidak memiliki akses');
});

test('users can not authenticate with invalid password', function () {
    $user = User::factory()->create();

    $this->post('/login', [
        'email' => $user->email,
        'password' => 'wrong-password',
    ]);

    $this->assertGuest();
});

test('users can logout', function () {
    $user = User::factory()->create();

    $response = $this->actingAs($user)->post('/logout');

    $this->assertGuest();
    $response->assertRedirect('/');
});
