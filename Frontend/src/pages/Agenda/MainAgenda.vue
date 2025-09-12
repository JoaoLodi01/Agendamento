<template>
    <q-page>
        <div class="flex justify-between items-center mx-10 mb-5">
            <h1 class="text-3xl text-gray-700">Listagem de agendamentos</h1>

            <q-btn
                label="Cadastrar Agendamento"
                color="primary"
                class="rounded-xl"
            />
        </div>

        <div class="grid grid-cols-3 mx-10 gap-6">
        
            <div class="col-span-2 bg-white rounded-xl shadow-md p-4 h-[85vh]">
                <div class="flex justify-between">
                    <div class="text-2xl">
                        {{ formattedMonth }}
                    </div>
                    
                    <q-select
                        v-model="viewAgenda"
                        label="Visualização"
                        outlined
                        dense
                        options-dense
                        :options="[
                            { label: 'Dia', value: 'day' },
                            { label: 'Semana', value: 'week' },
                            { label: 'Mês', value: 'month' }
                        ]"
                        style="width: 180px"
                    />
                </div>
                <div class="">
                    <div class="mb-4">
                        
                    </div>

                    <q-calendar
                        ref="agenda"
                        v-model="selectedDate"
                        :view="viewAgenda.value"
                        :weekdays="[0, 1, 2, 3, 4, 5, 6]"
                        :day-min-height="200"
                        bordered
                        animated
                        locale="pt-BR"
                        :events="filteredEvents"
                        class="h-[70vh]"
                    />
                </div>
            </div>

            
            <div class="bg-white p-4 rounded-xl shadow-md">
                <q-date
                    v-model="selectedDate"
                    mask="YYYY-MM-DD"
                    class="full-width mb-4"
                />

                <div>
                    <h3 class="text-lg mb-2">Atendentes</h3>
                    <q-checkbox
                        v-for="attendant in attendants"
                        :key="attendant.id"
                        v-model="selectedAttendants"
                        :label="attendant.full_name"
                        :val="attendant.id"
                    />
                </div>
            </div>
        </div>
    </q-page>
</template>

<script setup lang="ts">
import { ref, computed, onMounted } from 'vue'
import { api } from 'src/boot/axios';
import { LocalStorage } from 'quasar';
import { QCalendarAgenda } from '@quasar/quasar-ui-qcalendar'

    const events = ref([])
    const attendants = ref([])
    const viewAgenda = ref({
        label: 'Dia', value: 'day'
    })
    const selectedAttendants = ref<number[]>([])
    const issuerId = LocalStorage.getItem('issuer_id');
    const selectedDate = ref(new Date().toISOString().substring(0, 10))

    const filteredEvents = computed(() => {
        if (selectedAttendants.value.length === 0) {
            return events.value
        }

        return events.value.filter(e => selectedAttendants.value.includes(e.attendantId))
    })

    const formattedMonth = computed(() => {
        const date = new Date(selectedDate.value)
            return new Intl.DateTimeFormat('pt-BR', { month: 'long' }).format(date) + ' ' + date.getFullYear()
    })

    onMounted(async () => {
        try {
            const res = await api.get(`attendant/all/${issuerId}`, {
                headers: {
                    Authorization: `Bearer ${localStorage.getItem('token')}`
                },

            });

            attendants.value = Array.isArray(res.data) ? res.data : [];
            console.log(res);

        } catch (error) {
            console.log('Erro ao carregar usuários: ', error);
        }
    });

</script>
