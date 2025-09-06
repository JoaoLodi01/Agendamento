<template>
    <q-layout view="lHh Lpr lFf">
        <q-header elevated>
            <q-toolbar>
                <div>
                    <span class="cursor-pointer">
                        Sobre
                    </span>
                    <span class="cursor-pointer">
                        Contato
                    </span>
                </div>
                <q-toolbar-title>
                    
                </q-toolbar-title>
                
                <div class="">
                    <q-btn
                        flat
                        label="Cadastrar"
                        @click="openRegister"
                        class="text-black bg-white rounded-sm mr-4"
				    />

                    <q-btn
                        flat
                        label="Entrar"
                        @click="openLogin"
                        class="text-black bg-white rounded-sm a"
                    />
                </div>
            </q-toolbar>
        </q-header>

        <q-page-container>
            <router-view />
        </q-page-container>
    </q-layout>
</template>

<script setup lang="ts">
	import { ref } from 'vue';
    import { useRouter } from 'vue-router';

    const router = useRouter()

    function openLogin () {
        router.push('/auth/login')
    }

    function openRegister () {
        router.push('/auth/register')
    }

</script>
