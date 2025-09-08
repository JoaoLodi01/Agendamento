<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 w-96">
        <div class="bg-white border-2 border-gray-300 rounded-xl shadow-lg p-10 w-full max-w-md">
            <h1 class="text-3xl font-bold text-center mb-6">Resetar senha</h1>

            <q-form @submit.prevent="sendLogin">

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
    const password = ref<string>('');
    const showPassword = ref<boolean>(false);

        async function sendLogin() {
            const details = { email: email.value, password: password.value }

            try {
                const res = await api.post("/login", details, {
                    headers: {
                        Accept: 'application/json'
                    }
                });

                console.log(res.data);

                if(res.data.success){
                    if (res.data.token) {
                        LocalStorage.set("auth_token", res.data.token);
                        LocalStorage.set("user_id", res.data.user.id);
                    }

                    $q.notify({
                        color: 'green',
                        message: 'Login bem sucedido!',
                        position: 'top',
                        timeout: 2000
                    });

                    router.push('/admin');
                } else {
                    $q.notify({
                        color: 'red',
                        message: 'Erro no login',
                        position: 'top',
                        timeout: 2000
                    })
                };

            } catch (error) {
                console.error(error);

                $q.notify({
                    color: 'red',
                    message: 'Erro no servidor. Tente novamente mais tarde.',
                    position: 'top'
                });
            }
        }

        function togglePasswordVisibility() {
            showPassword.value = !showPassword.value;
        }

</script>
