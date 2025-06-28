<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use App\Jobs\DeleteCompletedTask;

class TaskController extends Controller
{
    // Lista (cache 10min)
    public function index()
    {
        return Cache::remember('tasks.index', now()->addMinutes(10), function () {
            return Task::orderBy('created_at', 'desc')->get();
        });
    }

    // Cria
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'        => 'required|string|max:255',
            'descricao'   => 'nullable|string',
            'data_limite' => 'nullable|date',
        ]);

        $task = Task::create($data);

        // invalida cache
        Cache::forget('tasks.index');

        return response()->json($task, 201);
    }

    // Exibe
    public function show(int $id)
    {
        return Cache::remember("tasks.show.{$id}", now()->addMinutes(10), function () use ($id) {
            return Task::findOrFail($id);
        });
    }

    // Atualiza
    public function update(Request $request, int $id)
    {
        $data = $request->validate([
            'nome'        => 'sometimes|required|string|max:255',
            'descricao'   => 'nullable|string',
            'data_limite' => 'nullable|date',
            'finalizado'  => 'sometimes|boolean',
        ]);

        $task = Task::findOrFail($id);
        $task->update($data);

        // invalida caches
        Cache::forget('tasks.index');
        Cache::forget("tasks.show.{$id}");

        return response()->json($task);
    }

    // Soft delete
    public function destroy(int $id)
    {
        $task = Task::findOrFail($id);
        $task->delete();

        Cache::forget('tasks.index');
        Cache::forget("tasks.show.{$id}");

        return response()->json(null, 204);
    }

    // Toggle + job
    public function toggle(int $id)
    {
        $task = Task::findOrFail($id);
        $task->finalizado = !$task->finalizado;
        $task->save();

        Cache::forget('tasks.index');
        Cache::forget("tasks.show.{$id}");

        if ($task->finalizado) {
            DeleteCompletedTask::dispatch($task->id)->delay(now()->addMinutes(10));
        }

        return response()->json($task);
    }
}
