<?php

namespace Tests\Feature;

use App\Livewire\ProductsManager;
use App\Livewire\UsersManager;
use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Livewire\Livewire;
use Tests\TestCase;

class AdminFlowTest extends TestCase
{
    use DatabaseTransactions;

    public function test_admin_can_login()
    {
        $person = \App\Models\Person::create(['names' => 'Admin Person', 'surnames' => 'Test', 'address' => 'Test', 'phone' => '123']);
        $email = 'admin_test_' . uniqid() . '@test.com';
        $admin = User::factory()->create([
            'email' => $email,
            'password' => bcrypt('password'),
            'status_id' => 1,
            'role_id' => 1,
            'person_id' => $person->id,
        ]);

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
        $person = \App\Models\Person::create(['names' => 'Admin Person', 'surnames' => 'Test', 'address' => 'Test', 'phone' => '123']);
        $uniqueAdminEmail = 'admin_users_' . uniqid() . '@test.com';
        $admin = User::factory()->create(['email' => $uniqueAdminEmail, 'status_id' => 1, 'role_id' => 1, 'person_id' => $person->id]);
        $this->actingAs($admin);

        $newUserEmail = 'new_' . uniqid() . '@example.com';

        // 1. Render
        $this->get('/users')->assertStatus(200);

        // 2. Create
        Livewire::test(UsersManager::class)
            ->set('name', 'New User')
            ->set('email', $newUserEmail)
            ->set('password', 'secret')
            ->call('save')
            ->assertSet('managingUser', false);

        $this->assertDatabaseHas('users', ['email' => $newUserEmail]);

        // 3. Update
        $user = User::where('email', $newUserEmail)->first();
        Livewire::test(UsersManager::class)
            ->call('edit', $user->id)
            ->set('name', 'Updated User')
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
        $person = \App\Models\Person::create(['names' => 'Admin Person', 'surnames' => 'Test', 'address' => 'Test', 'phone' => '123']);
        $uniqueAdminEmail = 'admin_prod_' . uniqid() . '@test.com';
        $admin = User::factory()->create(['email' => $uniqueAdminEmail, 'status_id' => 1, 'role_id' => 1, 'person_id' => $person->id]);
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
