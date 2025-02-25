<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use App\Models\Task;
use App\Models\User;

class TaskTest extends TestCase
{
    use RefreshDatabase; // Resets database after each test

    protected $user;

    protected function setUp(): void
    {
        parent::setUp();

        // Create and authenticate a user
        $this->user = User::factory()->create();
        $this->actingAs($this->user);
    }

    /** @test */
    public function it_can_create_a_task()
    {
        $response = $this->post(route('task.store'), [
            'title' => 'Test Task',
            'description' => 'This is a test task.',
            // No need to pass status or user_id because they are set by default.
        ]);

        $response->assertRedirect(route('task.index'));
        $this->assertDatabaseHas('tasks', [
            'title'       => 'Test Task',
            'description' => 'This is a test task.',
            'status'      => 'pending', // Default value
            'user_id'     => $this->user->id,
        ]);
    }

    /** @test */
    public function it_can_view_a_task()
    {
        // Create a task associated with the authenticated user
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get(route('task.show', $task->id));

        $response->assertStatus(200);
        $response->assertSee($task->title);
    }

    /** @test */
    public function it_can_update_a_task()
    {
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->post(route('task.update', $task->id), [
            'title'       => 'Updated Task',
            'description' => 'Updated description',
            'status'      => 'completed'
        ]);

        $response->assertRedirect(route('task.index'));
        $this->assertDatabaseHas('tasks', [
            'id'          => $task->id,
            'title'       => 'Updated Task',
            'description' => 'Updated description',
            'status'      => 'completed',
            'user_id'     => $this->user->id,
        ]);
    }

    /** @test */
    public function it_can_delete_a_task()
    {
        $task = Task::factory()->create(['user_id' => $this->user->id]);

        $response = $this->get(route('task.delete', $task->id));

        $response->assertRedirect(route('task.index'));
        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }

    
}
