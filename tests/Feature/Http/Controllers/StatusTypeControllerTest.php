<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\StatusType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\StatusTypeController
 */
final class StatusTypeControllerTest extends TestCase
{
    use RefreshDatabase;
    use WithFaker;

    protected function setUp(): void
    {
        parent::setUp();
        $this->actingAs($this->createAdminUser());
        $this->withoutMiddleware([
            \App\Http\Middleware\RoleUser::class,
            \App\Http\Middleware\StatusUser::class,
        ]);
    }

    #[Test]
    public function index_displays_view(): void
    {
        StatusType::factory()->count(2)->create();

        $response = $this->get(route('status-types.index'));

        $response->assertOk();
    }

    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('status-types.create'));

        $response->assertOk();
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $name = 'New Status Type';

        $response = $this->post(route('status-types.store'), [
            'name' => $name,
        ]);

        $this->assertDatabaseHas('status_types', ['name' => $name]);

        $response->assertRedirect(route('status-types.index'));
    }

    #[Test]
    public function show_displays_view(): void
    {
        $statusType = StatusType::factory()->create();

        $response = $this->get(route('status-types.show', $statusType));

        $response->assertOk();
    }

    #[Test]
    public function edit_displays_view(): void
    {
        $statusType = StatusType::factory()->create();

        $response = $this->get(route('status-types.edit', $statusType));

        $response->assertOk();
    }

    #[Test]
    public function update_saves_and_redirects(): void
    {
        $statusType = StatusType::factory()->create();

        $response = $this->put(route('status-types.update', $statusType), [
            'name' => 'Updated Name',
        ]);

        $statusType->refresh();

        $this->assertEquals('Updated Name', $statusType->name);
        $response->assertRedirect(route('status-types.index'));
    }

    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $statusType = StatusType::factory()->create();

        $response = $this->delete(route('status-types.destroy', $statusType));

        $response->assertRedirect(route('status-types.index'));
        $this->assertModelMissing($statusType);
    }
}
