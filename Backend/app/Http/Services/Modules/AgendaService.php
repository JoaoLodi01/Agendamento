<?php

namespace App\Http\Services;

use Illuminate\Http\Request;
use App\Http\Repositories\Eloquent\AgendaRepository;
use App\Http\Requests\AgendaRequest;
use App\Models\Client;
use App\Models\Issuer;
use App\Models\Service;
use App\Models\User;
use Exception;

class AgendaService
{
    public function __construct (
        protected AgendaRepository $agendaRepository
    ){}

    public function index(int $issuer_id)
    {
        return $this->agendaRepository->index($issuer_id);
    }

    public function hours(int $issuer_id)
    {
        return $this->agendaRepository->hours($issuer_id);
    }

    public function storeClient(Array $data, int $issuer_id)
    {
        $attendant = User::find($data['attendant_id']);
        $client = Client::find($data['client_id']);
        $service = Service::find($data['service_id']);
        $issuer = Issuer::find($issuer_id);

        if (!$attendant || !$client || !$service || !$issuer) {
            throw new Exception("Informações insucifientes");
        }

        if ($attendant->issuer_code !== $issuer->id || !$attendant->active || $attendant->role !== 'attendant'){
            throw new Exception("Atendente inválido ou inativo");
        }

        if ($service->issuer_code !== $issuer->id || !$service->active){
            throw new Exception("Serviço inválido ou inativo");
        }

        $this->agendaRepository->storeClient([
            'attendant_id' => $attendant->id,
            'client_id' => $client->id,
            'service_id' => $service->id,
            'issuer_id' => $issuer->id,
            'status' => $data['status'],
            'day_of_week' => $data['day_of_week'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'break_start' => $data['break_start'],
            'break_end' => $data['break_end'],
            'service_interval' => $data['service_interval'],
            'sheduled_at' => $data['sheduled_at'],
            'price' => $data['price'],
            'status' => 'scheduled',
        ]);
    }
    
    public function storeManual(Array $data, int $issuer_id)
    {
        $attendant = User::where('id', $data['attendant_id'])
                        ->where('issuer_id', $issuer_id)
                        ->where('active', true)
                        ->where('role', 'attendant')
                        ->first();

        $client = Client::where($data['client_id'])
                        ->where('issuer_id', $issuer_id)
                        ->where('active', true)
                        ->first();

        $service = Service::where($data['service_id'])
                        ->where('issuer_id', $issuer_id)
                        ->where('active', true)
                        ->first();

        $issuer = Issuer::find($issuer_id);

        if (!$attendant || !$client || !$service || !$issuer) {
            throw new Exception("Informações insucifientes");
        }

        if ($attendant->issuer_code !== $issuer->id || !$attendant->active || $attendant->role !== 'attendant'){
            throw new Exception("Atendente inválido ou inativo");
        }

        if ($service->issuer_code !== $issuer->id || !$service->active){
            throw new Exception("Serviço inválido ou inativo");
        }

        $this->agendaRepository->storeManual([
            'attendant_id' => $attendant->id,
            'client_id' => $client->id,
            'service_id' => $service->id,
            'issuer_id' => $issuer->id,
            'status' => $data['status'],
            'day_of_week' => $data['day_of_week'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
            'break_start' => $data['break_start'],
            'break_end' => $data['break_end'],
            'service_interval' => $data['service_interval'],
            'sheduled_at' => $data['sheduled_at'],
            'price' => $data['price'],
            'status' => 'scheduled',
        ]);
    }

    public function show(string $id)
    {
        //
    }

    public function update(AgendaRequest $request, string $id)
    {
        //
    }

    public function delete(string $id)
    {
        //
    }
}
