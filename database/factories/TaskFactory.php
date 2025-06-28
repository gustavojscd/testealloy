<?php

namespace Database\Factories;

use App\Models\Task;
use Illuminate\Database\Eloquent\Factories\Factory;

class TaskFactory extends Factory
{
    protected $model = Task::class;

    public function definition()
    {
        return [
            'nome'        => $this->faker->sentence(3),
            'descricao'   => $this->faker->paragraph(),
            'finalizado'  => $this->faker->boolean(20), // 20% concluídas
            'data_limite' => $this->faker->optional()->dateTimeBetween('now', '+1 month'),
        ];
    }
}
