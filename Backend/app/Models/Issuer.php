<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Issuer extends Model
{
    protected $table = 'issuers';

    protected $fillable = [
        'company_name',
        'cnpj',
        'cpf',
        'uf',
        'municipality',
        'address',
        'number',
        'district',
        'complement',
        'cep',
        'user_code',
        'active',
    ];

    public function users()
    {
        return $this->hasMany(User::class, 'issuer_code', 'id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'issuer_code');
    }
}
