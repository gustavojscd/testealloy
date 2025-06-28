<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Models\Task;
use App\Jobs\DeleteCompletedTask;

class DeleteCompletedTaskTest extends TestCase
{
    use RefreshDatabase;

    public function test_handle_deletes_soft_deleted_task()
    {
        $task = Task::factory()->create();
        $task->delete();

        $job = new DeleteCompletedTask($task->id);
        $job->handle();

        $this->assertDatabaseMissing('tasks', ['id' => $task->id]);
    }
}
