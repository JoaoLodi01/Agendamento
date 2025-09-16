<template>
    <q-page>
         <div class="flex justify-between items-center mx-10 mb-5">
            <h1 class="text-3xl text-gray-700">Histórico de comissões</h1>
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

    type TComissionTable = {
        id: number;
        description: string;
        value: string;

    };

    const router = useRouter();
    const selectedRows = ref([]);
    const rows = ref<TComissionTable[]>([]);
    const issuerId = LocalStorage.getItem('issuer_id');

    const columns: QTableColumn<TComissionTable>[] = [
        { name: 'description', label: 'Descrição', align: 'center', field: 'description', sortable: true },
        { name: 'value', label: 'Valor', align: 'center', field: 'value', sortable: true },
    ];

    onMounted(async () => {
        try {
            const res = await api.get(`comissions/all/${issuerId}`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            });
            rows.value = Array.isArray(res.data.Dados) ? res.data.Dados : [];
            console.log(res.data.Dados);

        } catch (error) {
            console.log('Erro ao carregar comissões: ', error);
        }
    });

    watch(selectedRows, (newVal) => {
        console.log(newVal);
    });

</script>
