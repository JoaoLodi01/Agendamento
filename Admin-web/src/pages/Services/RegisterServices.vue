<template>
    <q-page>
        <div class="flex justify-between items-center mx-10 mb-10">
            <h1 class="text-3xl text-gray-700">Cadastrar serviços</h1>
        </div>

        <div class="mx-10 bg-white h-[38vh] p-5 rounded-xl shadow-md overflow-auto">

            <div class="flex justify-between">
                <q-btn
                    icon="arrow_back"
                    label="Voltar"
                    flat
                    dense
                    @click="returnPage()"
                    class="mb-4"
                />

                <div>
                    <q-checkbox
                        label="Serviço a domicílio"
                        v-model="form.home_service"
                        class="mr-8"
                    />

                    <q-checkbox
                        label="Checar disponibilidade"
                        v-model="form.check_availability"
                    />
                </div>
            </div>
            
            <q-form class="grid grid-cols-2 gap-6">
                <div class="">
                    <q-input
                        type="text"
                        label="Nome serviço *"
                        v-model="form.service"
                        outlined
                        rounded
                    />
                </div>

                <div class="col-12 col-md-6">
                    <q-input
                        type="text"
                        label="Tempo de duração *"
                        v-model="form.duration"
                        outlined
                        rounded>
                            <template v-slot:append>
                                <q-icon
                                    name="access_time"
                                    class="cursor-pointer"
                                />
                            </template>
                    </q-input>
                </div>

                <div class="col-12 col-md-6">
                    <q-input
                        type="text"
                        label="Valor *"
                        v-model="form.price"
                        outlined
                        rounded
                    />
                </div>

                <div class="col-12 col-md-6">
                    <q-select
                        label="Categorias"
                        outlined
                        rounded
                        v-model="form.categories_id"
                    />
                </div>

                <div class="col-12 col-md-6">
                    <q-input
                        type="text"
                        label="Descrição"
                        v-model="form.description"
                        outlined
                        rounded
                    />
                </div>
            </q-form>

            <div class="flex justify-end w-full mt-5">
                <q-btn 
                    label="Cadastrar" 
                    type="submit" 
                    color="primary"
                    rounded
                    unelevated 
                    @click="sendForm"
                />
            </div>
        </div>
    </q-page>
</template>

<script setup lang="ts">

import { useQuasar } from "quasar";
import { ref } from "vue";
import { useRouter } from 'vue-router';
import { api } from "src/boot/axios";
import { LocalStorage } from 'quasar';

    const router = useRouter();
    const $q = useQuasar();
    const issuerId = LocalStorage.getItem('issuer_id');
    const form = ref({
        service: '',
        duration: '',
        price: 0,
        categories_id: '',
        description: '',
        home_service: false,
        check_availability: false,
    })

    function returnPage() {
        router.push('/admin/services');
    }

    async function sendForm() {
        try {
            const req = await api.post(`services/store/${issuerId}`, form.value);
            
            console.log(form.value);
            $q.notify({
                color: 'green',
                position: 'top',
                message: 'Serviço registrado com sucesso!'
            });

            router.push('/admin/services');
        } catch (error) {
            $q.notify({
                color: 'red',
                position: 'top',
                message: 'Falha ao cadastrar.'
            });

            console.log(error);
            console.log(issuerId);
        }
    }

</script>