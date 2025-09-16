<template>
    <q-page>
        <div class="flex justify-between items-center mx-10 mb-2">
            <h1 class="text-3xl text-gray-700">Cadastrar atendentes</h1>

            <q-btn 
                label="Gravar" 
                type="submit" 
                color="primary"
                rounded
                unelevated 
                @click="saveSchedules"
            />
        </div>

        <div class="mx-10 bg-white max-h-[90vh] p-4 rounded-lg shadow-md overflow-hidden">
            <q-btn
                icon="arrow_back"
                label="Voltar"
                flat
                dense
                @click="returnPage()"
                class="mb-5"
            />
            
            <q-form class="grid grid-cols-2 gap-2">
                <div v-for="(day, index) in scheduleForm" :key="index" class="mb-4 border p-3 rounded-md">
                    <div class="flex items-center mb-2">
                        <q-toggle 
                            v-model="day.active"
                        />
                        <span 
                            class="ml-2 font-medium text-lg">
                            {{ daysOfWeek[day.day_of_week] }}
                        </span>
                    </div>

                    <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 gap-3">
                        <q-input
                            filled
                            v-model="day.start_time"
                            label="Início"
                            :disable="!day.active"
                            dense
                            outlined
                        >
                            <template v-slot:append>
                                <q-icon name="access_time" class="cursor-pointer">
                                <q-popup-proxy transition-show="scale" transition-hide="scale">
                                    <q-time 
                                    v-model="day.start_time" 
                                    format24h 
                                    mask="HH:mm"
                                    emit-value
                                    dense
                                    />
                                </q-popup-proxy>
                                </q-icon>
                            </template>
                        </q-input>

                        <q-input 
                            dense  
                            v-model="day.end_time" 
                            label="Fim" 
                            mask="##:##" 
                            :disable="!day.active" 
                        />
                        <q-input 
                            dense  
                            v-model="day.break_start" 
                            label="Intervalo início" 
                            mask="##:##" 
                            :disable="!day.active"
                        />
                        <q-input 
                            dense  
                            v-model="day.break_end" 
                            label="Intervalo fim" 
                            mask="##:##" 
                            :disable="!day.active"
                        />
                    </div>

                    <div class="mt-4">
                        <q-select
                            v-model="day.service_interval"
                            :options="serviceIntervalOptions"
                            label="Intervalo entre serviços"
                            outlined
                            dense
                            :disable="!day.active"
                        />
                    </div>
                </div>
            </q-form>
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
    const attendant = ref();
    const daysOfWeek = [
        'Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'
    ]
    const serviceIntervalOptions = [
        { label: '15 minutos', value: 15 },
        { label: '30 minutos', value: 30 },
        { label: '45 minutos', value: 45 },
        { label: '60 minutos', value: 60 }
    ]

    const scheduleForm = ref(
        daysOfWeek.map((day, index) => ({
            day_of_week: index,
            active: false,
            start_time: '',
            end_time: '',
            break_start: '',
            break_end: '',
            service_interval: null
        }))
    )

    function returnPage() {
        router.push('/admin/attendants');
    }

    async function saveSchedules() {
        const payload = scheduleForm.value.filter(d => d.active)
        try {
            await api.post('/schedules/store', {
                attendant_id: '',
                schedules: payload
            })

            $q.notify({ 
                color: 'green',
                message: 'Horários salvos com sucesso!'
            })

            router.push('/admin/attendants')
        } catch (err) {
            $q.notify({ 
                color: 'red', 
                message: 'Erro ao salvar horários' 
            })
        }
    }

</script>