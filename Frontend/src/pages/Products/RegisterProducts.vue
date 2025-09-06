<template>
    <q-page>
        <div>
            <h2 class="font-bold">Produtos</h2>
        </div>

        <q-form submit.prevent="">
            <q-input
                type="text"
                label="Nome"
            />
            
            <q-input
                type="text"
                label="Valor"
            />

            <q-input
                type="text"
                label="Quantidade"
            />
            
            <q-checkbox>
                Ativo
            </q-checkbox>
        </q-form>
    </q-page>
</template>