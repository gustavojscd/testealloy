<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController;
/**
 * @OA\Info(
 *   title="Alloy ToDo API",
 *   version="1.0.0",
 *   description="API para gerenciamento de tarefas (To-Do List)",
 *   @OA\Contact(
 *     name="Alloy Dev Team",
 *     email="dev@alloy.com"
 *   )
 * )
 *
 * @OA\Server(
 *   url=L5_SWAGGER_CONST_HOST,
 *   description="Servidor local"
 * )
 */
Route::apiResource('tasks', TaskController::class);
/**
 * @OA\Patch(
 *   path="/api/tasks/{task}/toggle",
 *   operationId="toggleTask",
 *   tags={"Tasks"},
 *   summary="Alterna status de finalizado da tarefa",
 *   @OA\Parameter(
 *     name="task",
 *     in="path",
 *     description="ID da tarefa",
 *     required=true,
 *     @OA\Schema(type="integer", format="int64")
 *   ),
 *   @OA\Response(
 *     response=200,
 *     description="Tarefa atualizada",
 *     @OA\JsonContent(ref="#/components/schemas/Task")
 *   ),
 *   @OA\Response(response=404, description="Tarefa não encontrada")
 * )
 */
Route::patch('tasks/{task}/toggle', [TaskController::class, 'toggle']);
