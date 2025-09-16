<template>
    <q-page>
         <div class="flex justify-between items-center mx-10 mb-5">
            <h1 class="text-3xl text-gray-700">Configurações gerais</h1>
        </div>

        <div class="mx-10 bg-white h-[85vh] p-10 rounded-xl shadow-md overflow-auto">
            <div class="q-gutter-sm">
                <q-input
                    v-model="siteUrl"
                    label="URL do seu site"
                    outlined
                    dense
                    readonly
                    @click="openSite"
                    class="cursor-pointer"
                />
            </div>
        </div>
    </q-page>
</template>

<script setup lang="ts">
import { onMounted, ref, watch } from 'vue';
import { api } from 'src/boot/axios';
import { useRouter } from 'vue-router'
import { LocalStorage } from 'quasar';

    const baseUrl = 'http://192.168.1.106:9000/client/default';
    const siteUrl = ref(`${baseUrl}`);

    function openSite() {
        window.open(siteUrl.value, '_blank');
    }

</script>
