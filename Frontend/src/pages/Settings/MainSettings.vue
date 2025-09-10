<template>
    <q-page>
         <div class="flex justify-between items-center mx-10 mb-5">
            <h1 class="text-3xl text-gray-700">Configurações gerais</h1>
        </div>

        <div class="mx-10 bg-white h-[85vh] p-10 rounded-xl shadow-md overflow-auto">
            
        </div>
    </q-page>
</template>

<script setup lang="ts">
import { onMounted, ref, watch } from 'vue';
import { api } from 'src/boot/axios';
import { useRouter } from 'vue-router'
import { LocalStorage } from 'quasar';
import type { QTableColumn } from 'quasar';

    type TAttendantsTable = {
        id: number;
        full_name: string;
        email: string;
        phone: string;
        role: string;
    };

    const issuerId = LocalStorage.getItem('issuer_id');
    const router = useRouter();


</script>
