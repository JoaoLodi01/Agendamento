<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 w-96">
        <div class="bg-white border-2 border-gray-300 rounded-xl shadow-lg p-10 w-full max-w-md">
            <h1 class="text-3xl font-bold text-center mb-6">Confirme o e-mail</h1>

            <q-form @submit.prevent="sendEmail">

                <q-input
                    v-model="email"
                    type="text" 
                    label="E-mail" 
                    outlined
                    class="mb-5"
                    :rules="[val => !!val || 'O e-mail é necessário!']"
                />

                <div class="text-center mt-4 mb-4">
                    <q-btn 
                        label="Enviar e-mail" 
                        type="submit" 
                        color="primary"
                        class="p-4 rounded-md w-full"
                        unelevated 
                    />
                </div>
                
            </q-form>
        </div>
    </div>
</template>

<script setup lang="ts">
import { ref } from "vue";
import { api } from "src/boot/axios";
import { useRouter } from 'vue-router';
import { useQuasar, LocalStorage } from 'quasar';

    const $q = useQuasar();
    const router = useRouter();
    const email = ref<string>('');

    async function sendEmail() {
        try {
            const res = await api.post('/')
        } catch (error) {
            $q.notify({
                color: 'red',
                message: 'Erro ao enviar, contate o suporte!',
                position: 'top'
            });
        }
    }
</script>
