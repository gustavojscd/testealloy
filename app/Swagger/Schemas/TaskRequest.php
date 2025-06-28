<?php

namespace App\Swagger\Schemas;

/**
 * @OA\Schema(
 *   schema="TaskRequest",
 *   type="object",
 *   required={"nome"},
 *   @OA\Property(property="nome",        type="string"),
 *   @OA\Property(property="descricao",   type="string", nullable=true),
 *   @OA\Property(property="data_limite", type="string", format="date-time", nullable=true)
 * )
 */
class TaskRequest {}
