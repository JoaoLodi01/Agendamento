<template>
	<q-layout view="lHh Lpr lFf">
		<q-header elevated>
			<q-toolbar>
				<q-btn
					flat
					dense
					round
					icon="menu"
					aria-label="Menu"
					@click="toggleLeftDrawer"
				/>
				

				<q-toolbar-title>
					Gerenciamento
				</q-toolbar-title>

				<q-btn
					flat
					dense
					round
					icon="logout"
					@click="logout"
				/>
			</q-toolbar>
		</q-header>

		<q-drawer v-model="leftDrawerOpen" show-if-above bordered>
			<q-list>
				<q-item-label header>
					Nome da empresa aqui
				</q-item-label>

				<q-item clickable v-ripple>
					<q-item-section avatar>
						<q-icon name="dashboard" />
					</q-item-section>
					<q-item-section>
						Dashboard
					</q-item-section>
				</q-item>

				<q-item clickable v-ripple>
					<q-item-section avatar>
						<q-icon name="agenda" />
					</q-item-section>
					<q-item-section>
						Agenda
					</q-item-section>
				</q-item>

				<q-item clickable v-ripple>
					<q-item-section avatar>
						<q-icon name="comission" />
					</q-item-section>
					<q-item-section>
						Comissões
					</q-item-section>
				</q-item>

				<q-item clickable v-ripple>
					<q-item-section avatar>
						<q-icon name="services" />
					</q-item-section>
					<q-item-section>
						Serviços
					</q-item-section>
				</q-item>

				<q-item clickable v-ripple>
					<q-item-section avatar>
						<q-icon name="attendants" />
					</q-item-section>
					<q-item-section>
						Atendentes
					</q-item-section>
				</q-item>

				<q-item clickable v-ripple>
					<q-item-section avatar>
						<q-icon name="client" />
					</q-item-section>
					<q-item-section>
						Clientes
					</q-item-section>
				</q-item>

				<q-item clickable v-ripple>
					<q-item-section avatar>
						<q-icon name="categories" />
					</q-item-section>
					<q-item-section>
						Categorias
					</q-item-section>
				</q-item>

				<q-item clickable v-ripple>
					<q-item-section avatar>
						<q-icon name="products" />
					</q-item-section>
					<q-item-section>
						Produtos
					</q-item-section>
				</q-item>

				<q-item clickable v-ripple>
					<q-item-section avatar>
						<q-icon name="settings" />
					</q-item-section>
					<q-item-section>
						Configurações
					</q-item-section>
				</q-item>

			</q-list>
		</q-drawer>

		<q-page-container>
			
		</q-page-container>
		
		</q-layout>
	</template>

<script setup lang="ts">
	import { ref } from 'vue';

	const leftDrawerOpen = ref(false);

	function toggleLeftDrawer () {
		leftDrawerOpen.value = !leftDrawerOpen.value;
	}

	function logout () {

	}
</script>
