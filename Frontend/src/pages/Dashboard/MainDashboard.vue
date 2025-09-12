<template>
    <q-page>
        <div class="grid grid-cols-3 ml-20 mt-20">
            <div class="bg-blue-600 text-white rounded-xl max-w-96 min-h-32 shadow-md mb-4">
                <h1 class="text-lg p-5 font-bold">Faturamento total</h1>
                <h2 class="text-3xl m-5 font-bold">|    R$ 0,00</h2>
            </div>

            <div class="bg-blue-500 text-white rounded-xl max-w-96 min-h-32 shadow-md mb-4">
                <h1 class="text-lg p-5 font-bold">Totais de clientes</h1>
                <h2 class="text-3xl m-5 font-bold">|    0</h2>
            </div>

            <div class="bg-blue-800 text-white rounded-xl max-w-96 min-h-32 shadow-md mb-4 ">
            <h1 class="text-lg p-5 font-bold">Total de atendimentos</h1>
                <h2 class="text-3xl m-5 font-bold">|    0</h2>
            </div>

            <div class="border border-gray-300 bg-white text-gray-700 rounded-xl max-w-96 min-h-32 shadow-md mb-4">
                <h2 class="text-lg p-5 font-bold">Serviços mais agendados</h2>
            </div>

            <div class="border border-gray-300 bg-white text-gray-700 rounded-xl max-w-96 min-h-32 shadow-md mb-4">
                <h2 class="text-lg p-5 font-bold">Clientes mais atendidos</h2>
            </div>

            <div class="border border-gray-300 bg-white text-gray-700 rounded-xl max-w-96 min-h-80 shadow-md mb-4">
                <h2 class="text-lg p-5 font-bold">Clientes a mais tempo sem agendamento</h2>
            </div>

            <div class="border border-gray-300 bg-white text-gray-700 rounded-xl max-w-96 min-h-80 shadow-md mb-4">
                <h2 class="text-lg p-5 font-bold">Totais de comissões</h2>
            </div>

            <div class="border border-gray-300 bg-white text-gray-700 rounded-xl max-w-96 min-h-80 shadow-md mb-4">
                <h2 class="text-lg p-5 font-bold">Produtos mais vendidos</h2>
            </div>

            <div class="border border-gray-300 bg-white text-gray-700 rounded-xl max-w-96 min-h-80 shadow-md mb-4">
                <h2 class="text-lg p-5 font-bold">Melhores horários</h2>
            </div>
        </div>
        
    </q-page>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router'

    const router = useRouter()

        

</script>
