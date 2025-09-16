<template>
    <q-page>
         <div class="flex justify-between items-center mx-10 mb-5">
            <h1 class="text-3xl text-gray-700">Listagem de produtos</h1>

            <q-btn
                label="Cadastrar Produto"
                color="primary"
                class="mr-10 rounded-xl"
                @click="registerProducts()"
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
                                @click="editProduct(props.row)"
                            />

                            <q-btn
                                flat  
                                color="negative"
                                icon="delete" 
                                @click="deleteProduct(props.row)"
                                class="q-ml-sm"
                            />

                            <q-btn
                                flat  
                                color="black"
                                icon="visibility" 
                                @click="visibilityProduct(props.row)"
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

    type TProductsTable = {
        id: number;
        product: string;
        value: number;
        amount: number;
    };

    const router = useRouter();
    const selectedRows = ref([]);
    const rows = ref<TProductsTable[]>([]);
    const issuerId = LocalStorage.getItem('issuer_id');

    const columns: QTableColumn<TProductsTable>[] = [
        { name: 'product', label: 'Nome', align: 'center', field: 'product', sortable: true },
        { name: 'value', label: 'Valor', align: 'center', field: 'value', sortable: true },
        { name: 'amount', label: 'Quantidade', align: 'center', field: 'amount', sortable: true },
    ];

    function registerProducts() {
        router.push('/admin/products/register');
    }

    function editProduct(product: TProductsTable) {
        router.push('/admin/products/register');
    }

    function deleteProduct(product: TProductsTable) {
        router.push('/admin/products/register');
    }

    function visibilityProduct(product: TProductsTable) {
        router.push('/admin/products/register');
    }

    onMounted(async () => {
        try {
            const res = await api.get(`products/all/${issuerId}`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            });
            rows.value = Array.isArray(res.data.Dados) ? res.data.Dados : [];
            console.log(res.data.Dados);

        } catch (error) {
            console.log('Erro ao carregar produtos: ', error);
        }
    });

    watch(selectedRows, (newVal) => {
        console.log(newVal);
    });

</script>
