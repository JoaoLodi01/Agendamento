<template>
    <q-slide-fade>
        <q-page class="bg-image text-white" style="height: 100vh; background-image: url(''); background-size: cover; background-position: center;">
            <div class="flex flex-center full-height q-px-md" style="height: 100vh;">
                <div class="column items-center q-gutter-md" style="max-width: 900px;">
                    <h1 class="text-5xl text-center text-primary text-weight-bold">
                        Gestão de agendamentos automatizada para serviços modernos.
                    </h1>

                    <h3 class="text-subtitle1 text-center text-grey-8">
                        Reduza custos operacionais, otimize seu tempo e aumente a produtividade do seu negócio com uma solução completa e intuitiva.
                    </h3>

                    <q-btn
                        color="primary"
                        label="Teste grátis agora"
                        unelevated
                        class="q-mt-md"
                        size="lg"
                        rounded
                        @click="startFreeTrial"
                    />
                </div>
            </div>
        </q-page>
    </q-slide-fade>
</template>

<script setup lang="ts">
import { useRouter } from 'vue-router'

    const router = useRouter()

        function startFreeTrial() {
            router.push('/auth/register')
        }

</script>
