<template>
    <q-page class="flex flex-col items-center min-h-screen bg-gray-100">
        <div class="flex items-center mt-10 gap-4">
            <h1 class="text-6xl font-bold">Bem vindo!</h1>
            <h1 class="text-4xl text-gray-500">Faça sua reserva abaixo.</h1>
        </div>

        <div class="items-center mt-10 w-full max-w-md">
            <h2 class="text-2xl mb-6">Escolha um serviço</h2>

            <div
                class="mb-4 p-4 rounded shadow bg-white cursor-pointer hover:bg-gray-100 transition"
                v-for="(service, id) in services"
                :key="id"
                @click="selectService(service)"
                :class="{
                    'border-2 border-blue-500': serviceSelected?.id === service.id
                }"
            >
                <h3 class="text-lg font-semibold">{{ service.service }}</h3>
                <p class="text-gray-500">{{ service.description }}</p>
                <span class="text-green-600">R$ {{ service.price }}</span>
            </div>
        </div>

        <div class="items-center mt-10 w-full max-w-md">
            <h2 class="text-2xl mb-6">Escolha um atendente</h2>

            <div
                v-for="(attendant, id) in attendants"
                :key="id"
                @click="serviceSelected ? selectAttendant(attendant) : null"
                class="mb-4 p-4 rounded shadow transition text-center"
                :class="[
                    serviceSelected ? 'cursor-pointer bg-white hover:bg-gray-100' : 'bg-gray-200 cursor-not-allowed opacity-50',
                    attendantSelected?.id === attendant.id ? 'border-2 border-blue-500' : ''
                ]"
            >
                <h3 class="text-lg font-semibold">{{ attendant.full_name }}</h3>
            </div>
        </div>

        <div class="items-center mt-10 w-full max-w-md mb-20">
            <h2 class="text-2xl mb-6">Escolha um horário</h2>

            <div
                v-for="(hour, id) in hours"
                :key="id"
                @click="(serviceSelected && attendantSelected) ? selectHours(hour) : null"
                class="mb-4 p-4 rounded shadow transition"
                :class="[
                    (serviceSelected && attendantSelected) ? 'cursor-pointer bg-white hover:bg-gray-100' : 'bg-gray-200 cursor-not-allowed opacity-50',
                    hoursSelected?.id === hour.id ? 'border-2 border-blue-500' : ''
                ]"
            >
                <h3 class="text-lg font-semibold">{{ hour.description }}</h3>
            </div>
        </div>
    </q-page>
</template>

<script setup lang="ts">

import { onMounted, ref } from 'vue'
import { api } from 'src/boot/axios'
import { useQuasar } from 'quasar'
import { LocalStorage } from 'quasar'

    type THours = {
        id: number
        description: string
        client_id: number
        attendand_id: number
        service_id: number
        start_at: Date
        end_ad: Date
        price: number
        status: string
    }

    type TService = {
        id: number
        service: string
        duration: number
        price: number
        categories_id: number
        description: string
        home_service: boolean
        check_availability: boolean
    }

    type TAttendants = {
        id: number
        full_name: string
        cpf: number
        cnpj: number
        phone: number
        email: string
    }

    const $q = useQuasar()
    const services = ref<TService[]>([]) // ARRAY!
    const attendants = ref<TAttendants[]>([]) // ARRAY!
    const hours = ref<THours[]>([]) // ARRAY!
    const serviceSelected = ref<TService | null>(null)
    const attendantSelected = ref<TAttendants | null>(null)
    const hoursSelected = ref<THours | null>(null)
    const issuerId = LocalStorage.getItem('issuer_id')

    function selectService(service: TService) {
        serviceSelected.value = service
        attendantSelected.value = null
        hoursSelected.value = null
    }

    function selectAttendant(attendant: TAttendants) {
        attendantSelected.value = attendant
        hoursSelected.value = null
    }

    function selectHours(hour: THours) {
        hoursSelected.value = hour
    }

    onMounted(async () => {
        try {
            const attendantRes = await api.get(`attendant/all/${issuerId}`)
            attendants.value = attendantRes.data

            const servicesRes = await api.get(`services/all/${issuerId}`)
            services.value = servicesRes.data

            const hoursRes = await api.get(`agenda/all/${issuerId}`)
            hours.value = hoursRes.data
        } catch (error) {
            $q.notify({
            color: 'red',
            position: 'top',
            message: 'Falha ao buscar dados',
            })
        }
    })
</script>