<template>
    <q-page>
         <div class="flex justify-between items-center mx-10 mb-5">
            <h1 class="text-3xl text-gray-700">Listagem de atendentes</h1>

            <q-btn
                label="Cadastrar Atendente"
                color="primary"
                class="mr-10 rounded-xl"
            />
        </div>

        <div class="mx-10 bg-white h-[85vh] p-10 rounded-xl shadow-md overflow-auto">
            <q-table
                :rows="rows"
                :columns="columns"
                row-key="id"
                selection="multiple"
                v-model:selected="selectedRows"
                bordered
                class="rounded-xl bg-white  shadow-md"
            />

            
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

    const router = useRouter();
    const selectedRows = ref([]);
    const rows = ref<TAttendantsTable[]>([]);
    const issuerId = LocalStorage.getItem('issuer_id');

    const columns: QTableColumn[] = [
        { name: 'full_name', label: 'Nome', align: 'center', field: 'full_name', sortable: true },
        { name: 'email', label: 'E-mail', align: 'center', field: 'email', sortable: true },
        { name: 'phone', label: 'Contato', align: 'center', field: 'phone', sortable: true },
        { name: 'role', label: 'Função', align: 'center', field: 'role', sortable: true },
        { name: 'actions', label: 'Ações', align: 'center', field: 'actions', sortable: true },
    ];

    onMounted(async () => {
        try {
            const res = await api.get(`attendant/all/${issuerId}`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            });
            rows.value = Array.isArray(res.data) ? res.data : [];
            console.log(res);

        } catch (error) {
            console.log('Erro ao carregar usuários: ', error);
        }
    });

    watch(selectedRows, (newVal) => {
        console.log(newVal);
    });

</script>
