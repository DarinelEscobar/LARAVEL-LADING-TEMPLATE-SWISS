<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Tests\Feature\Api\ApiTestHelpers;

class ApiStandardTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        // Helpers for auth/seeding
        $this->seedReferenceData();
    }

    protected function seedReferenceData(): void
    {
        // Copying minimal logic from ApiTestHelpers if trait is not available or just inline it
        // Assuming Roles and Statuses need to exist
        if (\App\Models\Role::count() === 0) {
            \App\Models\Role::factory()->create(['id' => 1, 'name' => 'admin']);
            \App\Models\Role::factory()->create(['id' => 2, 'name' => 'user']);
        }
        if (\App\Models\Status::count() === 0) {
            $type = \App\Models\StatusType::factory()->create(['name' => 'general']);
            \App\Models\Status::factory()->create(['id' => 1, 'name' => 'active', 'status_type_id' => $type->id]);
        }
    }

    public function test_api_v1_prefix_is_required()
    {
        // Accessing without v1 should fail (404s usually if route not defined, or 302 if falling back to web?)
        // Since we moved routes, old routes don't exist.
        $user = User::factory()->create(['role_id' => 1, 'status_id' => 1]);

        $response = $this->actingAs($user, 'sanctum')->getJson('/api/users');
        $response->assertStatus(404);

        $responseV1 = $this->actingAs($user, 'sanctum')->getJson('/api/v1/users');
        $responseV1->assertStatus(200);
    }

    public function test_api_response_structure_success()
    {
        $user = User::factory()->create(['role_id' => 1, 'status_id' => 1]);
        $this->actingAs($user, 'sanctum');

        $response = $this->getJson('/api/v1/user');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'message',
                'data',
                'meta' => [
                    'timestamp',
                    'path',
                    'version'
                ]
            ])
            ->assertJson([
                'status' => 'success',
                'message' => 'OK',
                'meta' => [
                    'version' => 'v1'
                ]
            ]);
    }

    public function test_api_response_structure_pagination()
    {
        $user = User::factory()->create(['role_id' => 1, 'status_id' => 1]);
        $this->actingAs($user, 'sanctum');

        User::factory()->count(15)->create();

        $response = $this->getJson('/api/v1/users');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'status',
                'data', // Array of users
                'meta' => [
                    'pagination' => [
                        'total',
                        'count',
                        'per_page',
                        'current_page',
                        'total_pages',
                        'links'
                    ]
                ]
            ]);
    }

    public function test_404_model_not_found()
    {
        $user = User::factory()->create(['role_id' => 1, 'status_id' => 1]);
        $this->actingAs($user, 'sanctum');

        $response = $this->getJson('/api/v1/users/99999');

        $response->assertStatus(404)
            ->assertJson([
                'status' => 'error',
                'message' => 'Resource not found',
                'error_code' => 'RESOURCE_NOT_FOUND'
            ]);
    }

    public function test_404_endpoint_not_found()
    {
        $user = User::factory()->create(['role_id' => 1, 'status_id' => 1]);
        $this->actingAs($user, 'sanctum');

        $response = $this->getJson('/api/v1/unknown-endpoint');

        $response->assertStatus(404)
            ->assertJson([
                'status' => 'error',
                'message' => 'Endpoint not found',
                'error_code' => 'ENDPOINT_NOT_FOUND'
            ]);
    }

    public function test_401_unauthenticated()
    {
        $response = $this->getJson('/api/v1/users');

        $response->assertStatus(401)
            ->assertJson([
                'status' => 'error',
                'message' => 'Unauthenticated',
                'error_code' => 'AUTH_FAILED'
            ]);
    }

    public function test_422_validation_error()
    {
        $user = User::factory()->create(['role_id' => 1, 'status_id' => 1]);
        $this->actingAs($user, 'sanctum');

        // Sending empty data to user creation
        $response = $this->postJson('/api/v1/users', []);

        $response->assertStatus(422)
            ->assertJson([
                'status' => 'error',
                'message' => 'Validation failed',
                'error_code' => 'VALIDATION_ERROR'
            ])
            ->assertJsonStructure(['errors']);
    }
}
