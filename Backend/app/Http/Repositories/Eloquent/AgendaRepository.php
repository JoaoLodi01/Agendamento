<?php

namespace App\Http\Repositories\Eloquent;

use App\Models\Agenda;
use App\Models\Attemda;
use App\Models\Issuer;
use App\Models\Service;
use Illuminate\Support\Facades\Log;

class AgendaRepository
{
    public function index(int $issuer_id)
    {   
        $issuer = Issuer::findOrFail($issuer_id);

        $agenda = Agenda::where('issuer_code', $issuer->id)->get();

        return $agenda;
    }

    public function hours(int $attendant_id, int $issuer_id)
    {   
        $attendant = 
        $issuer = Issuer::findOrFail($issuer_id);

        $hour = Agenda::where('issuer_code', $issuer->id)->get();

        return $hour;
    }

    public function storeClient(array $data, int $issuer_id)
    {
        $issuer = Issuer::findOrFail($issuer_id);
        Log::info("StoreClient - Issuer ID: " . $issuer->id);

        $agenda = Agenda::create([
            'client_id' => $data['client_id'] ?? null,
            'attendant_id' => $data['attendant_id'],
            'service_id' => $data['service_id'],
            'day_of_week' => $data['day_of_week'] ?? null,
            'start_time' => $data['start_time'] ?? null,
            'end_time' => $data['end_time'] ?? null,
            'break_start' => $data['break_start'] ?? null,
            'break_end' => $data['break_end'] ?? null,
            'service_interval' => $data['service_interval'] ?? 30,
            'status' => $data['status'] ?? 'scheduled',
            'price' => $data['price'] ?? 0,
            'issuer_code' => $issuer->id,
            'active' => $data['active'] ?? true,
        ]);

        return $agenda;
    }

    public function storeManual(array $data, int $issuer_id)
    {
        $issuer = Issuer::findOrFail($issuer_id);

        if (isset($data['service_id'])) {
            $service = Service::find($data['service_id']);
            if ($service) {
                $serviceInterval = $service->service_interval ?? 30;
            }
        }

        $startTime = $data['time'] . ':00';

        $startDateTime = \DateTime::createFromFormat('H:i:s', $startTime);
        $endDateTime = clone $startDateTime;
        $endDateTime->modify("+{$serviceInterval} minutes");
        $endTime = $endDateTime->format('H:i:s');

        $agenda = Agenda::create([
            'client_id' => $data['client_id'] ?? null,
            'attendant_id' => $data['attendant_id'],
            'service_id' => $data['service_id'],
            'day_of_week' => $data['day_of_week'] ?? null,
            'start_time' => $startTime,
            'end_time' => $endTime,
            'break_start' => $data['break_start'] ?? null,
            'break_end' => $data['break_end'] ?? null,
            'service_interval' => $serviceInterval,
            'status' => $data['status'] ?? 'scheduled',
            'price' => $data['price'] ?? 0,
            'issuer_code' => $issuer->id,
            'active' => $data['active'] ?? true,
        ]);

        return $agenda;
    }

    public function show(int $id)
    {
        return Agenda::where('id', $id)->first();
    }
    
    public function update(array $data, int $id)
    {
        return Agenda::where('id', $id)
                    ->update($data);
    }
    
    public function delete(int $id)
    {
        return Agenda::where('id', $id)
                    ->update([
                        'active' => 0,
                    ]);
    }
}