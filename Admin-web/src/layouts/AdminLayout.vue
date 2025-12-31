<template>
	<q-layout view="lHh Lpr lFf">
		<q-btn
			flat
			dense
			round
			icon="menu"
			class="mt-2 ml-2"
			@click="leftDrawerOpen = !leftDrawerOpen"
		/>
		<q-drawer
			v-model="leftDrawerOpen"
			show-if-above
			bordered
			class="bg-black text-white"
			>

			<div class="column fit">
				<div>
					<q-btn
						flat
						dense
						round
						icon="menu"
						class="mt-1 ml-1"
						@click="leftDrawerOpen = !leftDrawerOpen"
					/>

					<div class="flex flex-center mt-2 mb-4">
						<q-img
						src="/logo.png"
						@click="router.push('/admin/dashboard')"
						class="cursor-pointer w-64"
						/>
					</div>
				</div>

				<q-scroll-area class="col">
					<q-list>
						<q-item
						v-for="link in links"
						:key="link.label"
						clickable
						tag="router-link"
						:to="link.to"
						class="mb-2 ml-2 w-64"
						:class="{ 'bg-primary px-10 text-white rounded-xl': route.path.startsWith(link.to) }"
						>
						<q-item-section avatar>
							<component :is="link.icon" class="w-5 h-5 text-white" />
						</q-item-section>

						<q-item-section>
							<q-item-label class="text-base">
							{{ link.label }}
							</q-item-label>
						</q-item-section>
						</q-item>
					</q-list>
				</q-scroll-area>

				
				<div class="q-pa-md flex flex-center">
					<q-btn
						label="Sair"
						icon="logout"
						outlined
						dense
						@click="logout"
						class="w-32"
					/>
				</div>

			</div>
			</q-drawer>


		<q-page-container>
			<router-view />
		</q-page-container>
	</q-layout>
</template>

<script setup lang="ts">
import { ref } from 'vue';
import { LocalStorage, useQuasar } from 'quasar';
import { useRoute, useRouter } from 'vue-router';
import {
	CalendarIcon,
	Cog6ToothIcon,
	UsersIcon,
	ClipboardDocumentCheckIcon,
	UserGroupIcon,
	FolderIcon,
	ChartBarIcon,
	HomeIcon,
	KeyIcon,
} from '@heroicons/vue/24/outline';

	const $q = useQuasar();
	const router = useRouter();
	const route = useRoute();
	const leftDrawerOpen = ref(false);

	const links = [
		{ label: 'Dashboard', icon: HomeIcon, to: '/admin/dashboard' },
		{ label: 'Agenda', icon: CalendarIcon, to: '/admin/agenda' },
		{ label: 'Comissões', icon: ChartBarIcon, to: '/admin/comissions' },
		{ label: 'Serviços', icon: ClipboardDocumentCheckIcon, to: '/admin/services' },
		{ label: 'Atendentes', icon: UserGroupIcon, to: '/admin/attendants' },
		{ label: 'Clientes', icon: UsersIcon, to: '/admin/clients' },
		{ label: 'Categorias', icon: FolderIcon, to: '/admin/categories' },
		{ label: 'Produtos', icon: FolderIcon, to: '/admin/products' },
		{ label: 'Configurações', icon: Cog6ToothIcon, to: '/admin/settings' },
		{ label: 'Licença', icon: KeyIcon, to: '/admin/license' }
	];

	function logout() {
		LocalStorage.remove("auth_token");
		LocalStorage.remove("issuer_id");
		router.push("/auth/login");

		$q.notify({
			color: 'green',
			message: 'Logout concluído!',
			position: 'top',
			timeout: 2000
		});
	}
</script>
