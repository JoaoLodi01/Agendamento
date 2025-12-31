<template>
    <q-page>
        <div class="flex justify-between items-center mx-10 mb-5">
            <h1 class="text-3xl text-gray-700">Cadastrar produtos</h1>
        </div>

        <div class="mx-10 bg-white h-[60vh] p-10 rounded-xl shadow-md overflow-auto">
            <q-btn
                icon="arrow_back"
                flat
                round
                dense
                @click="returnPage()"
            />
        </div>
    </q-page>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router';

    const router = useRouter();

    function returnPage() {
        router.push('/admin/products');
    }

</script>