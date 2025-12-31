<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 w-96">
        <div class="bg-white border-2 border-gray-300 rounded-xl shadow-lg p-10 w-full max-w-md">
            <h1 class="text-3xl font-bold text-center mb-6">Login</h1>

            <q-form @submit.prevent="sendLogin">

            <q-input
                v-model="email"
                type="text" 
                label="E-mail" 
                outlined
                class="mb-5"
                :rules="[val => !!val || 'O e-mail é necessário!']"
            />

            <q-input
                v-model="password"
                :type="showPassword ? 'text' : 'password'"  
                label="Senha" 
                outlined
                class=""
                :rules="[val => !!val || 'A senha é necessária!']"
            >
                <template v-slot:append>
                    <q-icon 
                            name="visibility" 
                            @click="togglePasswordVisibility" 
                            class="cursor-pointer"
                        />
                </template>
            </q-input>

            <span class="text-blue-500 cursor-pointer flex justify-end text-xs" @click="router.push('/auth/reset-password')">
                Esqueceu sua senha?
            </span>

            <div class="text-center mt-4 mb-4">
                <q-btn 
                label="Entrar" 
                type="submit" 
                color="primary"
                class="p-4 rounded-md w-full"
                unelevated 
                />
            </div>

            <div class="flex justify-between text-xs">
                <span class="text-blue-500 cursor-pointer mr-2" @click="router.push('/auth/register')">
                    Não tem uma conta?
                </span>
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
    const showLoading = ref<boolean>(false);

        async function sendLogin() {
            showLoading.value = true;
            const details = { email: email.value, password: password.value }

            try {
                const res = await api.post("/auth/login", details, {
                    headers: {
                        Accept: 'application/json'
                    }
                });
                
                console.log(res.data);

                if(res.data.token){
                    LocalStorage.set("auth_token", res.data.token);
                    LocalStorage.set("user_id", res.data.user.id);
                    LocalStorage.set("issuer_id", res.data.user.issuer_code);

                    $q.notify({
                        color: 'green',
                        message: 'Login bem sucedido!',
                        position: 'top',
                        timeout: 2000
                    });

                    router.push('/admin/dashboard');
                } else {
                     $q.notify({
                        color: 'red',
                        message: 'Não foi possível autenticar',
                        position: 'top',
                        timeout: 2000
                    });
                };

            } catch (error) {
                console.error(error);

                $q.notify({
                    color: 'red',
                    message: 'Erro no servidor. Tente novamente mais tarde.',
                    position: 'top'
                });
            } finally {showLoading.value = false}
        }

        function togglePasswordVisibility() {
            showPassword.value = !showPassword.value;
        }

</script>
