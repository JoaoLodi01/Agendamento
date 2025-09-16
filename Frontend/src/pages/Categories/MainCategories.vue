<template>
    <q-page>
         <div class="flex justify-between items-center mx-10 mb-5">
            <h1 class="text-3xl text-gray-700">Listagem de categorias</h1>

            <q-btn
                label="Cadastrar categoria"
                color="primary"
                class="mr-10 rounded-xl"
                @click="registerCategories()"
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
                                @click="editCategorie(props.row)"
                            />

                            <q-btn
                                flat  
                                color="negative"
                                icon="delete" 
                                @click="deleteCategorie(props.row)"
                                class="q-ml-sm"
                            />

                            <q-btn
                                flat  
                                color="black"
                                icon="visibility" 
                                @click="visibilityCategorie(props.row)"
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

    type TCategoriesTable = {
        id: number;
        categorie: string;
        desctiption: string;
    };

    const router = useRouter();
    const selectedRows = ref([]);
    const rows = ref<TCategoriesTable[]>([]);
    const issuerId = LocalStorage.getItem('issuer_id');

    const columns: QTableColumn<TCategoriesTable>[] = [
        { name: 'categorie', label: 'Categoria', align: 'center', field: 'categorie', sortable: true },
        { name: 'desctiption', label: 'Descrição', align: 'center', field: 'desctiption', sortable: true },
    ];

    function registerCategorie() {
        router.push('/admin/categories/register');
    }

    function editCategorie(categorie: TCategoriesTable) {
        router.push('/admin/categories/register');
    }

    function deleteCategorie(categorie: TCategoriesTable) {
        router.push('/admin/categories/register');
    }

    function visibilityCategorie(categorie: TCategoriesTable) {
        router.push('/admin/categories/register');
    }

    onMounted(async () => {
        try {
            const res = await api.get(`categories/all/${issuerId}`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                }
            });
            rows.value = Array.isArray(res.data.Dados) ? res.data.Dados : [];
            console.log(res.data.Dados);

        } catch (error) {
            console.log('Erro ao carregar categorias: ', error);
        }
    });

    watch(selectedRows, (newVal) => {
        console.log(newVal);
    });

</script>
