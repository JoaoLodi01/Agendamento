<?php

namespace App\Http\Services;

use App\Http\Repositories\Eloquent\LicenseRepository;
use App\Models\License;
use Carbon\Carbon;
use Exception;
use illuminate\Support\Str;

class LicenseService
{
    public function __construct(
        protected LicenseRepository $licenseRepository
    ){}

    public function validateOfFail(int $issuer_id): License
    {
        $license = License::with('plan')
                        ->where('issuer_id', $issuer_id)
                        ->first();

        if (!$license) {
            throw new Exception("Empresa não possui licença", 1);
        }

        if (!$license->active || $license->suspended) {
            throw new Exception("Licença inativa ou suspensa", 1);
        }

        if ($license->expires_at && Carbon::now()->greaterThan($license->expires_at)) {
            throw new Exception("Licença expirada", 1);
        }

        return $license;
    }
}