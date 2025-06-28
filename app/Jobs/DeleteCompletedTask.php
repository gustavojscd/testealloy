<?php

namespace App\Jobs;

use App\Models\Task;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteCompletedTask implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public  int $taskId;

    public function __construct(int $taskId)
    {
        $this->taskId = $taskId;
    }

    public function handle(): void
    {
        $task = Task::withTrashed()->find($this->taskId);
        if ($task) {
            $task->forceDelete();
        }
    }
}
