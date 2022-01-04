<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Move extends Model
{
    use HasFactory;

    protected $fillable = [
        "type_id",
        "data",
        "valor",
        "cpf",
        "cartao",
        "hora",
        "dono_da_loja",
        "loja"
    ];
}
