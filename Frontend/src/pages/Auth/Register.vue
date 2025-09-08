<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100 w-96">
        <div class="bg-white border-2 border-gray-300 rounded-xl shadow-lg p-8 w-full max-w-md">
            <h1 class="text-2xl font-bold text-center mb-6">Registrar</h1>

            <q-form @submit.prevent="sendRegister">

                <q-input
                    v-model="name"
                    type="text" 
                    label="Nome" 
                    outlined
                    class="mb-5"
                    :rules="[val => !!val || 'O nome é necessário!']"
                />

                <q-input
                    v-model="email"
                    type="text" 
                    label="E-mail" 
                    outlined
                    class="mb-5"
                    :rules="[val => !!val || 'O e-mail é necessário!']"
                />

                <q-input
                    v-model="whatsapp" 
                    type="text" 
                    label="WhatsApp" 
                    outlined
                    class="mb-5"
                    :rules="[val => !!val || 'O número é necessário!']"
                />

                <q-input
                    v-model="password" 
                    :type="showPassword ? 'text' : 'password'" 
                    label="Senha" 
                    outlined
                    class="mb-3"
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

                <q-input
                    v-model="confirmPassword" 
                    :type="showPassword ? 'text' : 'password'"  
                    label="Confirmar senha" 
                    outlined
                    class="mb-3"
                    :rules="[val => !!val || 'A confirmação é necessária!']"
                >
                    <template v-slot:append>
                        <q-icon 
                            name="visibility" 
                            @click="togglePasswordVisibility" 
                            class="cursor-pointer"
                        />
                    </template>
                </q-input>

                <div class="text-center mt-4 mb-4">
                    <q-btn 
                        label="Cadastrar" 
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
    const name = ref<string>('');
    const email = ref<string>('');
    const whatsapp = ref<string>('');
    const password = ref<string>('');
    const confirmPassword = ref<string>('');
    const showPassword = ref<boolean>(false);

    async function sendRegister() {
        const payload = {
            name: name.value,
            email: email.value,
            whatsapp: whatsapp.value,
            password: password.value
        }

        try {
            const res = await api.post("/auth/register", payload);
            console.log(res.data);

            if (password.value !== confirmPassword.value) {
                $q.notify({
                    color: 'red',
                    message: 'As senhas não coincidem!',
                    position: 'top'
                });

                return;
            }

            if(res.data.success){
                $q.notify({
                    color: 'green',
                    message: 'Usuário cadastrado!',
                    position: 'top',
                    timeout: 2000
                });

                router.push("/login");
            } else {
                $q.notify({
                    color: 'red',
                    message: 'Erro ao cadastrar',
                    position: 'top',
                    timeout: 2000
                });
            }
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
