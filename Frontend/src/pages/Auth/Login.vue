<template>
    <div class="flex items-center justify-center min-h-screen bg-gray-100">
        <div class="bg-white border-2 border-gray-300 rounded-xl shadow-lg p-8 w-full max-w-md">
            <h1 class="text-2xl font-bold text-center mb-6">Login</h1>

            <q-form @submit.prevent="">

            <q-input 
                type="text" 
                label="E-mail" 
                outlined
                class="mb-5"
                :rules="[val => !!val || 'O e-mail é necessário!']"
            />

            <q-input 
                type="password" 
                label="Senha" 
                outlined
                class="mb-3"
                :rules="[val => !!val || 'A senha é necessária!']"
            >
                <template v-slot:append>
                <div @click="">
                    <PasswordIcon />
                </div>
                </template>
            </q-input>

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
                <span class="text-blue-500 cursor-pointer mr-2">Não tem uma conta?</span>
                <span class="text-blue-500 cursor-pointer mb-2">Esqueceu sua senha?</span>
            </div>
            </q-form>
        </div>
    </div>
</template>
