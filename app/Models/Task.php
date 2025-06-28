<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory; // ← importe

class Task extends Model
{
    use HasFactory, SoftDeletes; // ← adicione HasFactory

    protected $fillable = [
        'nome',
        'descricao',
        'finalizado',
        'data_limite',
    ];

    protected $casts = [
        'finalizado'  => 'boolean',
        'data_limite' => 'datetime',
    ];
}
