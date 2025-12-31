<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class License extends Model
{
    protected $fillable = [
        'issuer_id',
        'plan_id',
        'starts_at',
        'expires_at',
        'active',
        'suspended',
    ];

    public function plans()
    {
        return $this->belongsTo(Plans::class);
    }

    public function issuer()
    {
        return $this->belongsTo(Issuer::class);
    }
}
