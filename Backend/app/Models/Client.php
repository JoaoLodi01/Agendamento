<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $table = 'clients';

    protected $fillable = [
        'full_name',
        'cpf',
        'cnpj',
        'phone',
        'email',
        'date_birth',
        'sex',
        'cep',
        'uf',
        'municipality',
        'address',
        'number',
        'district',
        'complement',
        'photo',
        'active',
    ];

    public function agendas()
    {
        return $this->hasMany(Agenda::class, 'client_id');
    }
}
