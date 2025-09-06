<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agenda extends Model
{
    use HasFactory;

    protected $table = 'agenda';

    protected $fillable = [
        'customer_id',
        'attendant_id',
        'service_id',
        'scheduled_at',
        'price',
        'status',
        'active',
    ];


    public function customer()
    {
        return $this->belongsTo(Customer::class, 'client_id');
    }

    public function attendant()
    {
        return $this->belongsTo(Attendant::class, 'attendant_id');
    }

    public function service()
    {
        return $this->belongsTo(Service::class, 'service_id');
    }
}
