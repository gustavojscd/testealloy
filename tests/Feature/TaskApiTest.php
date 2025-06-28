<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;
use App\Jobs\DeleteCompletedTask;
use Illuminate\Support\Facades\Queue;

class TaskApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_can_list_tasks()
    {
        Task::factory()->count(3)->create();

        $response = $this->getJson('/api/tasks');
        $response->assertStatus(200)
                 ->assertJsonCount(3);
    }

    public function test_can_create_task()
    {
        $data = [
            'nome'        => 'Test Task',
            'descricao'   => 'Descrição',
            'data_limite' => now()->addDay()->toDateTimeString(),
        ];

        $response = $this->postJson('/api/tasks', $data);
        $response->assertStatus(201)
                 ->assertJsonFragment(['nome' => 'Test Task']);

        $this->assertDatabaseHas('tasks', ['nome' => 'Test Task']);
    }

    public function test_can_show_task()
    {
        $task = Task::factory()->create();

        $response = $this->getJson("/api/tasks/{$task->id}");
        $response->assertStatus(200)
                 ->assertJsonFragment(['id' => $task->id]);
    }

    public function test_can_update_task()
    {
        $task = Task::factory()->create(['nome' => 'Old Name']);

        $response = $this->putJson("/api/tasks/{$task->id}", [
            'nome' => 'Updated Name'
        ]);

        $response->assertStatus(200)
                 ->assertJsonFragment(['nome' => 'Updated Name']);

        $this->assertDatabaseHas('tasks', ['id' => $task->id, 'nome' => 'Updated Name']);
    }

    public function test_can_soft_delete_task()
    {
        $task = Task::factory()->create();

        $response = $this->deleteJson("/api/tasks/{$task->id}");
        $response->assertStatus(204);

        $this->assertSoftDeleted('tasks', ['id' => $task->id]);
    }

    public function test_can_toggle_task_and_dispatch_job()
    {
        Queue::fake();
        $task = Task::factory()->create(['finalizado' => false]);

        $response = $this->patchJson("/api/tasks/{$task->id}/toggle");
        $response->assertStatus(200)
                 ->assertJsonFragment(['finalizado' => true]);

        Queue::assertPushed(DeleteCompletedTask::class, function ($job) use ($task) {
            return $job->taskId === $task->id;
        });
    }
}
