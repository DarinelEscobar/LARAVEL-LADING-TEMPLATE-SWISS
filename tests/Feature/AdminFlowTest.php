<?php

namespace Tests\Feature;

use App\Livewire\ProductsManager;
use App\Livewire\UsersManager;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class AdminFlowTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->withoutMiddleware([
            \App\Http\Middleware\RoleUser::class,
            \App\Http\Middleware\StatusUser::class,
        ]);
    }

    public function test_admin_can_login()
    {
        $email = 'admin_test_' . uniqid() . '@test.com';
        $admin = $this->createAdminUser(['email' => $email, 'password' => bcrypt('password')]);

        $response = $this->get('/login');
        $response->assertStatus(200);

        // Test Livewire Login
        Livewire::test('App\Livewire\Auth\Login')
            ->set('email', $email)
            ->set('password', 'password')
            ->call('login')
            ->assertRedirect('dashboard');

        $this->actingAs($admin);
        $this->get('/dashboard')->assertStatus(200);
    }

    public function test_admin_can_manage_users()
    {
        $uniqueAdminEmail = 'admin_users_' . uniqid() . '@test.com';
        $admin = $this->createAdminUser(['email' => $uniqueAdminEmail]);
        $this->actingAs($admin);

        $newUserEmail = 'new_' . uniqid() . '@example.com';

        // 1. Render
        $this->get('/users')->assertStatus(200);

        // 2. Create
        Livewire::test(UsersManager::class)
            ->set('person_names', 'New')
            ->set('person_surnames', 'User')
            ->set('email', $newUserEmail)
            ->set('password', 'password123')
            ->call('save')
            ->assertSet('managingUser', false);

        $this->assertDatabaseHas('users', ['email' => $newUserEmail]);

        // 3. Update
        $user = User::where('email', $newUserEmail)->first();
        Livewire::test(UsersManager::class)
            ->call('edit', $user->id)
            ->set('person_names', 'Updated')
            ->set('person_surnames', 'User')
            ->call('save');

        $this->assertDatabaseHas('users', ['name' => 'Updated User']);

        // 4. Delete
        Livewire::test(UsersManager::class)
            ->call('confirmDeletion', $user->id)
            ->call('delete');

        $this->assertDatabaseMissing('users', ['id' => $user->id]);
    }

    public function test_admin_can_manage_products()
    {
        $uniqueAdminEmail = 'admin_prod_' . uniqid() . '@test.com';
        $admin = $this->createAdminUser(['email' => $uniqueAdminEmail]);
        $this->actingAs($admin);

        // 1. Render
        $this->get('/products')->assertStatus(200);

        $uniqueName = 'Product_' . uniqid();

        // 2. Create
        Livewire::test(ProductsManager::class)
            ->set('name', $uniqueName)
            ->set('description', 'Desc')
            ->set('price', 100)
            ->set('stock', 50)
            ->call('save');

        $this->assertDatabaseHas('products', ['name' => $uniqueName]);

        // 3. Update
        $product = Product::where('name', $uniqueName)->first();

        Livewire::test(ProductsManager::class)
            ->call('edit', $product->id)
            ->set('price', 200)
            ->call('save');

        $this->assertDatabaseHas('products', ['price' => 200]);

        // 4. Delete
        Livewire::test(ProductsManager::class)
            ->call('confirmDeletion', $product->id)
            ->call('delete');

        $this->assertDatabaseMissing('products', ['id' => $product->id]);
    }
}
