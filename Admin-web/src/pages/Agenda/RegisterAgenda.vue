<template>
    <q-page>
        <div class="flex justify-between items-center mx-10 mb-6">
            <h1 class="text-3xl text-gray-700">Agendar horário</h1>
        </div>

        <div class="mx-10 bg-white p-6 rounded-xl shadow-md">
            <q-btn
                icon="arrow_back"
                label="Voltar"
                flat
                dense
                @click="returnPage()"
                class="mb-5"
            />

            <q-form class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <q-select
                    v-model="form.client_id"
                    :options="clients"
                    label="Cliente"
                    option-label="full_name"
                    option-value="id"
                    emit-value
                    map-options
                    outlined
                />

                <q-select
                    v-model="form.attendant_id"
                    :options="attendants"
                    label="Atendente"
                    option-label="full_name"
                    option-value="id"
                    emit-value
                    map-options
                    outlined
                />

                <q-select
                    v-model="form.service_id"
                    :options="services"
                    label="Serviço"
                    option-label="service"
                    option-value="id"
                    emit-value
                    map-options
                    outlined
                />

                <q-input v-model="form.date" label="Data" outlined>
                    <template v-slot:append>
                        <q-icon 
                            name="event" 
                            class="cursor-pointer"
                        >
                            <q-popup-proxy 
                                transition-show="scale" 
                                transition-hide="scale"
                            >
                                <q-date 
                                    v-model="form.date"
                                    mask="YYYY-MM-DD"
                                />
                            </q-popup-proxy>
                        </q-icon>
                    </template>
                </q-input>

                <q-input 
                    v-model="form.time" 
                    label="Hora" 
                    outlined
                >
                    <template v-slot:append>
                        <q-icon 
                            name="access_time" 
                            class="cursor-pointer"
                        >
                            <q-popup-proxy 
                                transition-show="scale" 
                                transition-hide="scale"
                            >
                                <q-time 
                                    v-model="form.time" 
                                    format24h mask="HH:mm" 
                                />
                            </q-popup-proxy>
                        </q-icon>
                    </template>
                </q-input>

                <q-input
                    v-model="form.notes"
                    label="Observações"
                    type="textarea"
                    autogrow
                    outlined
                    class="col-span-2"
                />
            </q-form>

            <div class="flex justify-end mt-8">
                <q-btn
                    label="Agendar"
                    color="primary"
                    rounded
                    unelevated
                    @click="submitForm"
                />
            </div>
        </div>
    </q-page>
</template>

<script setup lang="ts">
import { ref, onMounted } from 'vue'
import { useRouter } from 'vue-router'
import { useQuasar } from 'quasar'
import { api } from 'src/boot/axios'
import { LocalStorage } from 'quasar'

    const router = useRouter()
    const $q = useQuasar()

    const form = ref({
        client_id: null,
        attendant_id: null,
        service_id: null,
        date: '',
        time: '',
        notes: ''
    })

    const clients = ref([])
    const attendants = ref([])
    const services = ref([])
    const issuerId = LocalStorage.getItem('issuer_id');


    function returnPage() {
        router.push('/admin/agenda')
    }

    function formatTime(datetimeString: string) {
        return datetimeString.substring(11, 19);
    }

    async function submitForm() {
        try {
            await api.post(`/agenda/store/manual/${issuerId}`, form.value)

            $q.notify({
                color: 'green',
                message: 'Agendamento realizado com sucesso!'
            })

            router.push('/admin/agenda')
        } catch (err) {
            $q.notify({
                color: 'red',
                message: 'Erro ao agendar horário.'
            })
            console.log(err);
        }
    }

    onMounted(async() => {
        try {
            const [clientsRes, attendantsRes, servicesRes] = await Promise.all([
                api.get(`/client/all/${issuerId}`),
                api.get(`/attendant/all/${issuerId}`),
                api.get(`/services/all/${issuerId}`)
            ])

            clients.value = clientsRes.data.Dados
            attendants.value = attendantsRes.data.Dados
            services.value = servicesRes.data.Dados

            console.log('Clientes: ',clients.value)
            console.log('Atendentes: ',attendants.value)
            console.log('Serviços: ',services.value)
        } catch (err) {
            $q.notify({
                color: 'red',
                message: 'Erro ao carregar dados.'
            })
        }
    })

</script>