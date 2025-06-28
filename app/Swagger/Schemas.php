/**
 * @OA\Schema(
 *   schema="Task",
 *   type="object",
 *   title="Task",
 *   required={"id","nome","finalizado"},
 *   @OA\Property(property="id", type="integer", format="int64"),
 *   @OA\Property(property="nome", type="string"),
 *   @OA\Property(property="descricao", type="string", nullable=true),
 *   @OA\Property(property="finalizado", type="boolean"),
 *   @OA\Property(property="data_limite", type="string", format="date-time", nullable=true),
 *   @OA\Property(property="created_at", type="string", format="date-time"),
 *   @OA\Property(property="updated_at", type="string", format="date-time")
 * )
 *
 * @OA\Schema(
 *   schema="TaskRequest",
 *   type="object",
 *   title="TaskRequest",
 *   required={"nome"},
 *   @OA\Property(property="nome", type="string"),
 *   @OA\Property(property="descricao", type="string", nullable=true),
 *   @OA\Property(property="data_limite", type="string", format="date-time", nullable=true),
 * )
 */
