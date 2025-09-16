<template>
    <q-page>
         <div class="flex justify-between items-center mx-10 mb-5">
            <h1 class="text-3xl text-gray-700">Listagem de serviços</h1>

            <q-btn
                label="Cadastrar serviço"
                color="primary"
                class="mr-10 rounded-xl"
                @click="registerServices()"
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
                                @click="editService(props.row)"
                            />

                            <q-btn
                                flat  
                                color="negative"
                                icon="delete" 
                                @click="deleteService(props.row)"
                                class="q-ml-sm"
                            />

                            <q-btn
                                flat  
                                color="black"
                                icon="visibility" 
                                @click="visibilityService(props.row)"
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
import { useRouter } from 'vue-router'
import { LocalStorage } from 'quasar';
import type { QTableColumn } from 'quasar';

    type TServicesTable = {
        id: number;
        service: string;
        duration: string;
        price: number
        categories_id: number
        description: string
        home_service: boolean
        check_availability: boolean
    };

    const router = useRouter();
    const selectedRows = ref([]);
    const rows = ref<TServicesTable[]>([]);
    const issuerId = LocalStorage.getItem('issuer_id');

    const columns: QTableColumn[] = [
        { name: 'service', label: 'Serviço', align: 'center', field: 'service', sortable: true },
        { name: 'duration', label: 'Duração', align: 'center', field: 'duration', sortable: true },
        { name: 'price', label: 'Preço', align: 'center', field: 'price', sortable: true },
        { name: 'actions', label: 'Ações', align: 'center', field: 'actions', sortable: true },
    ];

    function registerServices() {
        router.push('/admin/services/register');
    }

    function editService(service: TServicesTable) {
        router.push('/admin/services/register');
    }

    function deleteService(service: TServicesTable) {
        router.push('/admin/services/register');
    }

    function visibilityService(service: TServicesTable) {
        router.push('/admin/services/register');
    }

    onMounted(async () => {
        try {
            const res = await api.get(`services/all/${issuerId}`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            });
            rows.value = Array.isArray(res.data.Dados) ? res.data.Dados : [];
            console.log("Serviços:", res.data.Dados);

        } catch (error) {
            console.log('Erro ao carregar serviços: ', error);
        }
    });

    watch(selectedRows, (newVal) => {
        console.log(newVal);
    });

</script>
