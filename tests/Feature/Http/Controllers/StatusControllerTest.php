<?php

namespace Tests\Feature\Http\Controllers;

use App\Models\Status;
use App\Models\StatusType;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use PHPUnit\Framework\Attributes\Test;
use Tests\TestCase;

/**
 * @see \App\Http\Controllers\StatusController
 */
final class StatusControllerTest extends TestCase
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
        Status::factory()->count(2)->create();

        $response = $this->get(route('statuses.index'));

        $response->assertOk();
    }

    #[Test]
    public function create_displays_view(): void
    {
        $response = $this->get(route('statuses.create'));

        $response->assertOk();
    }

    #[Test]
    public function store_saves_and_redirects(): void
    {
        $statusType = StatusType::factory()->create();

        $response = $this->post(route('statuses.store'), [
            'name' => 'Active',
            'order' => 1,
            'status_type_id' => $statusType->id,
        ]);

        $this->assertDatabaseHas('status', [
            'name' => 'Active',
            'order' => 1,
            'status_type_id' => $statusType->id,
        ]);

        $response->assertRedirect(route('statuses.index'));
    }

    #[Test]
    public function show_displays_view(): void
    {
        $status = Status::factory()->create();

        $response = $this->get(route('statuses.show', $status));

        $response->assertOk();
    }

    #[Test]
    public function edit_displays_view(): void
    {
        $status = Status::factory()->create();

        $response = $this->get(route('statuses.edit', $status));

        $response->assertOk();
    }

    #[Test]
    public function update_saves_and_redirects(): void
    {
        $status = Status::factory()->create();
        $newType = StatusType::factory()->create();

        $response = $this->put(route('statuses.update', $status), [
            'name' => 'Updated',
            'order' => 5,
            'status_type_id' => $newType->id,
        ]);

        $status->refresh();

        $this->assertEquals('Updated', $status->name);
        $this->assertEquals(5, $status->order);
        $this->assertEquals($newType->id, $status->status_type_id);
        $response->assertRedirect(route('statuses.index'));
    }

    #[Test]
    public function destroy_deletes_and_redirects(): void
    {
        $status = Status::factory()->create();

        $response = $this->delete(route('statuses.destroy', $status));

        $response->assertRedirect(route('statuses.index'));
        $this->assertModelMissing($status);
    }
}
