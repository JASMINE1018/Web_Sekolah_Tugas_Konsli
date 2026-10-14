<?php

namespace Tests\Feature;

use App\Models\Information;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SchoolSystemTest extends TestCase
{
    use RefreshDatabase;

    public function test_home_page_loads_successfully(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee('Sekolah Inspirasi');
    }

    public function test_login_page_loads_successfully(): void
    {
        $response = $this->get('/login');
        $response->assertStatus(200);
        $response->assertSee('Selamat datang kembali.');
    }

    public function test_admin_can_login_and_redirects_to_admin_dashboard(): void
    {
        $admin = User::factory()->create([
            'email' => 'admin@test.com',
            'role' => 'admin',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'admin@test.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('admin.dashboard'));
        $this->assertAuthenticatedAs($admin);
    }

    public function test_user_can_login_and_redirects_to_user_information(): void
    {
        $user = User::factory()->create([
            'email' => 'user@test.com',
            'role' => 'user',
            'password' => bcrypt('password123'),
        ]);

        $response = $this->post('/login', [
            'email' => 'user@test.com',
            'password' => 'password123',
        ]);

        $response->assertRedirect(route('user.information.index'));
        $this->assertAuthenticatedAs($user);
    }

    public function test_regular_user_cannot_access_admin_dashboard_shows_403_page(): void
    {
        $user = User::factory()->create([
            'role' => 'user',
        ]);

        $response = $this->actingAs($user)->get(route('admin.dashboard'));
        $response->assertStatus(403);
        $response->assertSee('Halaman ini khusus untuk admin.');
    }

    public function test_admin_can_create_update_and_delete_information(): void
    {
        $admin = User::factory()->create([
            'role' => 'admin',
        ]);

        // Create
        $response = $this->actingAs($admin)->post(route('admin.information.store'), [
            'title' => 'Kegiatan Menanam Pohon',
            'summary' => 'Kegiatan penghijauan sekolah bersama.',
            'content' => 'Siswa menanam berbagai pohon buah di kebun belakang.',
            'category' => 'Kegiatan',
            'status' => 'Terbit',
        ]);

        $response->assertRedirect(route('admin.information.index'));
        $this->assertDatabaseHas('information', [
            'title' => 'Kegiatan Menanam Pohon',
            'status' => 'Terbit',
        ]);

        $item = Information::first();

        // Update
        $this->actingAs($admin)->put(route('admin.information.update', $item), [
            'title' => 'Kegiatan Menanam Pohon Updated',
            'summary' => 'Ringkasan diubah',
            'content' => 'Konten diubah',
            'category' => 'Kegiatan',
            'status' => 'Terbit',
        ]);

        $this->assertDatabaseHas('information', [
            'id' => $item->id,
            'title' => 'Kegiatan Menanam Pohon Updated',
        ]);

        // Delete
        $this->actingAs($admin)->delete(route('admin.information.destroy', $item));
        $this->assertDatabaseMissing('information', [
            'id' => $item->id,
        ]);
    }
}
