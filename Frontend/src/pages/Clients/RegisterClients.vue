<template>
    <q-page>
        <div class="flex justify-between items-center mx-10 mb-10">
            <h1 class="text-3xl text-gray-700">Cadastrar cliente</h1>
        </div>

        <div class="mx-10 bg-white h-[35vh] p-5 rounded-xl shadow-md overflow-auto">
            <q-btn
                icon="arrow_back"
                label="Voltar"
                flat
                dense
                @click="returnPage()"
                class="mb-5"
            />
            
            <q-form class="grid grid-cols-2 gap-6">
                <div>
                    <q-input
                        type="text"
                        label="Nome completo *"
                        v-model="form.full_name"
                        outlined
                        rounded
                    />
                </div>

                <div>
                    <q-input
                        type="text"
                        label="E-mail"
                        v-model="form.email"
                        outlined
                        rounded
                    />
                </div>

                <div>
                    <q-input
                        type="text"
                        label="Telefone"
                        v-model="form.phone"
                        outlined
                        rounded
                    />
                </div>

                <div>
                    <q-input
                        type="text"
                        label="CPF"
                        v-model="form.cpf"
                        outlined
                        rounded
                    />
                </div>
            </q-form>

            <div class="flex justify-end w-full mt-10">
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
import { useRouter } from 'vue-router';
import { api } from "src/boot/axios";
import { ref } from "vue";
import { LocalStorage } from 'quasar'

    const $q = useQuasar();
    const router = useRouter();
    const issuerId = LocalStorage.getItem('issuer_id');
    const form = ref({
        full_name: '',
        email: '',
        phone: '',
        cpf: '',
    })

    function returnPage() {
        router.push('/admin/clients/');
    }

    async function sendForm() {
        try {
            const req = await api.post(`/client/store/${issuerId}`, form.value);
            
            $q.notify({
                color: 'green',
                position: 'top',
                message: 'Cleinte registrado com sucesso!'
            });
            console.log(req.data.Dados);

            router.push('/admin/clients/');
        } catch (error) {
            $q.notify({
                color: 'red',
                position: 'top',
                message: 'Falha ao cadastrar.'
            });
            console.log(error)
        }
    }
</script>