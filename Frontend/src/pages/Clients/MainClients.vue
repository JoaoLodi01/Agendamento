<template>
    <q-page>
         <div class="flex justify-between items-center mx-10 mb-5">
            <h1 class="text-3xl text-gray-700">Listagem de clientes</h1>

            <q-btn
                label="Cadastrar clientes"
                color="primary"
                class="mr-10 rounded-xl"
                @click="registerClient()"
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
                class="rounded-xl bg-white  shadow-md">

                    <template v-slot:body-cell-actions="props">
                        <q-td 
                            :props="props" 
                            align="center"
                        >

                            <q-btn
                                flat
                                color="primary"
                                icon="edit" 
                                @click="editClient(props.row)"
                            />

                            <q-btn
                                flat  
                                color="negative"
                                icon="delete" 
                                @click="deleteClient(props.row)"
                                class="q-ml-sm"
                            />

                            <q-btn
                                flat  
                                color="black"
                                icon="visibility" 
                                @click="visibilityClient(props.row)"
                                class="q-ml-sm"
                            />

                        </q-td>
                    </template>
            </q-table>
        </div>
    </q-page>
</template>

<script setup lang="ts">

import { onMounted, ref, watch } from 'vue';
import { api } from 'src/boot/axios';
import { useRouter } from 'vue-router';
import { LocalStorage } from 'quasar';
import type { QTableColumn } from 'quasar';

    type TClientsTable = {
        id: number;
        full_name: string;
        email: string;
        phone: string;
    };

    const router = useRouter();
    const selectedRows = ref([]);
    const rows = ref<TClientsTable[]>([]);
    const issuerId = LocalStorage.getItem('issuer_id');

    const columns: QTableColumn<TClientsTable>[] = [
        { name: 'full_name', label: 'Nome', align: 'center', field: 'full_name', sortable: true },
        { name: 'email', label: 'E-mail', align: 'center', field: 'email', sortable: true },
        { name: 'phone', label: 'Contato', align: 'center', field: 'phone', sortable: true },
    ];

    function registerClient() {
        router.push('/admin/clients/register');
    }

    function editClient(client: TClientsTable) {
        router.push('/admin/clients/register');
    }

    function deleteClient(client: TClientsTable) {
        router.push('/admin/clients/register');
    }

    function visibilityClient(client: TClientsTable) {
        router.push('/admin/clients/register');
    }

    onMounted(async () => {
        try {
            const res = await api.get(`client/all/${issuerId}`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            });
            rows.value = Array.isArray(res.data.Dados) ? res.data.Dados : [];
            console.log(res.data.Dados);

        } catch (error) {
            console.log('Erro ao carregar usuários: ', error);
        }
    });

    watch(selectedRows, (newVal) => {
        console.log(newVal);
    });

</script>
