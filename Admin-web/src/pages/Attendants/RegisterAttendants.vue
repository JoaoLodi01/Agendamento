<template>
    <q-page>
        <div class="flex justify-between items-center mx-10 mb-10">
            <h1 class="text-3xl text-gray-700">Cadastrar atendentes</h1>
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
                <div class="">
                    <q-input
                        type="text"
                        label="Nome completo *"
                        v-model="form.name"
                        outlined
                        rounded
                    />
                </div>

                <div class="col-12 col-md-6">
                    <q-input
                        type="text"
                        label="E-mail *"
                        v-model="form.email"
                        outlined
                        rounded
                    />
                </div>

                <div class="col-12 col-md-6">
                    <q-input
                        v-model="form.password"
                        :type="showPassword ? 'text' : 'password'"
                        label="Senha *"
                        outlined
                        rounded
                        :rules="[val => !!val || 'A senha é necessária!']"
                    >
                            <template v-slot:append>
                                <q-icon
                                name="visibility"
                                @click="PasswordVisibility"
                                class="cursor-pointer"
                                />
                            </template>
                    </q-input>
                </div>

                <div class="col-12 col-md-6">
                    <q-input
                        v-model="form.confirmPassword"
                        :type="showConfirmPassword ? 'text' : 'password'"
                        label="Confirmar senha *"
                        outlined
                        rounded
                        :rules="[val => !!val || 'A confirmação é necessária!']"
                    >
                            <template v-slot:append>
                                <q-icon
                                name="visibility"
                                @click="ConfirmPasswordVisibility"
                                class="cursor-pointer"
                                />
                            </template>
                    </q-input>
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
import { ref } from "vue";
import { useRouter } from 'vue-router';
import { api } from "src/boot/axios";

    const router = useRouter();
    const $q = useQuasar();
    const showPassword = ref<boolean>(false);
    const showConfirmPassword = ref<boolean>(false);
    const form = ref({
        name: '',
        email: '',
        password: '',
        confirmPassword: '',
    })

    function returnPage() {
        router.push('/admin/attendants');
    }

    function PasswordVisibility() {
        showPassword.value = !showPassword.value;
    }

    function ConfirmPasswordVisibility() {
        showConfirmPassword.value = !showConfirmPassword.value;
    }

    async function sendForm() {
        try {
            const req = await api.post('attendant/store', form);
            form.value = req.data;
            
            console.log(form.value);
        } catch (error) {
            $q.notify({
                color: 'red',
                position: 'top',
                message: 'Falha ao cadastrar.'
            });
        }
    }

</script>