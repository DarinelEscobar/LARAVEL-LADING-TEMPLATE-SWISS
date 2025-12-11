<?php

use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use function Pest\Laravel\deleteJson;
use function Pest\Laravel\getJson;
use function Pest\Laravel\postJson;
use function Pest\Laravel\putJson;

uses(RefreshDatabase::class);

beforeEach(function () {
    authenticateAsAdmin();
});

it('lists products', function () {
    Product::factory()->count(2)->create();

    getJson(route('api.products.index'))
        ->assertOk()
        ->assertJsonPath('status', 'success')
        ->assertJsonCount(2, 'data')
        ->assertJsonPath('meta.pagination.total', 2);
});

it('creates a product', function () {
    $payload = [
        'name' => 'Swiss Watch',
        'description' => 'Engineered for precision.',
        'price' => 999.99,
        'stock' => 5,
    ];

    postJson(route('api.products.store'), $payload)
        ->assertCreated()
        ->assertJsonPath('status', 'success')
        ->assertJsonPath('data.name', 'Swiss Watch')
        ->assertJsonPath('data.stock', 5);

    expect(Product::whereName('Swiss Watch')->exists())->toBeTrue();
});

it('updates a product', function () {
    $product = Product::factory()->create([
        'name' => 'Old Name',
        'stock' => 4,
    ]);

    $payload = [
        'name' => 'Updated Name',
        'description' => 'New description',
        'price' => 77.50,
        'stock' => 12,
    ];

    putJson(route('api.products.update', $product), $payload)
        ->assertOk()
        ->assertJsonPath('status', 'success')
        ->assertJsonPath('data.name', 'Updated Name')
        ->assertJsonPath('data.stock', 12);
});

it('deletes a product', function () {
    $product = Product::factory()->create();

    deleteJson(route('api.products.destroy', $product))
        ->assertOk()
        ->assertJsonPath('status', 'success')
        ->assertJsonPath('data', null);

    expect(Product::whereKey($product->id)->exists())->toBeFalse();
});
