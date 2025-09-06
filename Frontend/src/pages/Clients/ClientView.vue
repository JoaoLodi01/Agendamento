<template>
    <q-page class="flex flex-col items-center justify-center min-h-screen bg-gray-100 p-6">
        <h1 class="text-6xl font-bold mb-2 text-center">Faça sua reserva</h1>
        <h2 class="text-4xl mb-5 text-center">Rápida e prática</h2>

        <q-btn 
            label="Reservar" 
            color="primary" 
            class="mb-6 w-72 h-12 text-lg"
            unelevated
            @click="$router.push('/client/reserva')"
        />

        <div class="text-center text-gray-600 text-sm">
            <p>Horário: 08:00 - 18:00</p>
            <p>Contato: (49) 98915-3821</p>
        </div>
    </q-page>
</template>