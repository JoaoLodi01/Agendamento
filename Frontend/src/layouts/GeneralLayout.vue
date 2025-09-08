<template>
    <q-layout view="lHh Lpr lFf">
        <q-header elevated class="text-white bg-black">
            <q-toolbar class="justify-between items-center">

                <div class="row items-center" style="min-width: 150px;">

                    <div class="sm-hidden md:flex gap-6 text-xl font-serif">
                        <span class="cursor-pointer hover:text-primary transition" @click="router.push('/about')">
                            Sobre
                        </span>

                        <span class="cursor-pointer hover:text-primary transition" @click="router.push('/contact')">
                            Contato
                        </span>
                    </div>

                    <q-btn
                        flat
                        dense
                        round
                        icon="menu"
                        class="q-visible sm:block md:hidden"
                        @click="leftDrawerOpen = !leftDrawerOpen"
                    />
                </div>

                

                <q-toolbar-title class="text-center font-serif text-2xl cursor-pointer" style="flex-grow: 1; text-align: center;" @click="router.push('/general')">
                    <q-img
                        src="/logo.png"
                        style="max-width: 250px; max-height: 400px;"
                        fit="contain"
                        @click="router.push('/admin')"
                        class="cursor-pointer"
                    />
                </q-toolbar-title>

                <div class="row items-center q-gutter-sm" style="min-width: 150px; justify-content: flex-end;">
                    <q-btn
                        unelevated
                        label="Cadastrar"
                        @click="openRegister"
                        class="bg-primary text-white"
                        rounded
                    />
                    <q-btn
                        unelevated
                        label="Entrar"
                        @click="openLogin"
                        class="bg-secondary text-white"
                        rounded
                    />
                </div>
            </q-toolbar>
        </q-header>

        <q-drawer
            v-model="leftDrawerOpen"
            side="left"
            overlay
            behavior="mobile"
            class="bg-grey-2"
        >
            <q-list>
                <q-item clickable @click="router.push('/sobre')">
                    <q-item-section>Sobre</q-item-section>
                </q-item>

                <q-item clickable @click="router.push('/contato')">
                    <q-item-section>Contato</q-item-section>
                </q-item>
            </q-list>
        </q-drawer>

        <q-page-container>
            <router-view />
        </q-page-container>
    </q-layout>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router';
import { ref } from 'vue';

    const router = useRouter();
    const leftDrawerOpen = ref(false);

    function openLogin() {
        router.push('/auth/login');
    }

    function openRegister() {
        router.push('/auth/register');
    }
</script>
