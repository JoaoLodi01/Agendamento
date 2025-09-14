<template>
    <q-page class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-6">
        <h1 class="text-6xl font-bold mb-2 text-center">Reserve seu horário</h1>
        <h2 class="text-4xl mb-5 text-center">Rápido e prático</h2>

        <q-btn 
            label="Reservar" 
            color="primary" 
            class="mb-6 w-72 h-12 text-lg"
            unelevated
            @click="reservation()"
        />

        <div class="text-center text-gray-600 text-sm">
            <p>Horário: 08:00 - 18:00</p>
            <p>Contato: (49) 98915-3821</p>
        </div>
    </q-page>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router'

    const router = useRouter();

    function reservation() {
        router.push('/client/reservation');
    }

</script>