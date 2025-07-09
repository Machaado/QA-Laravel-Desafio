<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SolicitacaoCredito extends Model
{
    /** @use HasFactory<\Database\Factories\SolicitacaoCreditoFactory> */
    use HasFactory;

    protected $fillable = [
        'cliente_id',
        'valor',
        'status',
    ];

    public function cliente(){
        return $this->belongsTo(Cliente::class);
    }
}
