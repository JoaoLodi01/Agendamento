<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Sanctum\HasApiTokens;

class Attendant extends Authenticatable
{
    use HasFactory, HasApiTokens;

    protected $table = 'attendants';

    protected $fillable = [
        'full_name',
        'cpf',
        'cnpj',
        'phone',
        'email',
        'password',
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

    protected $hidden = [
        'password',
    ];

    public function agendas()
    {
        return $this->hasMany(Agenda::class, 'attendant_id');
    }
}
