<template>
    <q-page padding>
        <h1 class="text-3xl text-gray-700 text-start ml-10 mb-5">Listagem de atendentes</h1>

        <div class="bg-white text-gray-700 rounded-xl shadow-md ml-10 mr-10 h-[85vh]">
            <q-table
                :rows="rows"
                :columns="columns"
                row-key="id"
            />
        </div>
    </q-page>
</template>

<script setup lang="ts">
import { onMounted, ref } from 'vue';
import { api } from 'src/boot/axios';
import { useRouter } from 'vue-router'
import type { QTableProps } from 'quasar';

    const router = useRouter();
    const rows = ref([]);

    const columns: QTableProps['columns'] = [
        { name: 'name', label: 'Nome', align: 'center', field: 'name', sortable: true },
        { name: 'email', label: 'E-mail', align: 'center', field: 'email', sortable: true },
        { name: 'phone', label: 'Contato', align: 'center', field: 'phone', sortable: true },
        { name: 'function', label: 'Função', align: 'center', field: 'function', sortable: true },
    ];

    onMounted(async () => {
        try {
            const res = await api.get('attendant/all', {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            });
            rows.value = res.data;

        } catch (error) {
            console.log('Erro ao carregar usuários: ', error);
        }
    });

</script>
