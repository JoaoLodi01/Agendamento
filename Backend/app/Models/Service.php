<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Service extends Model
{
    use HasFactory;

    protected $table = 'services';

    protected $fillable = [
        'service',
        'duration',
        'price',
        'categories_id',
        'description',
        'home_service',
        'check_availability',
        'issuer_code',
        'active',
    ];

    public function agendas()
    {
        return $this->hasMany(Agenda::class, 'service_id');
    }
}
