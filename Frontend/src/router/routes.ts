import type { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
    // Rota de autenticação
    {
        path: '/auth',
        component: () => import('../layouts/AuthLayout.vue'),
        children: [
            { path: 'login', component: () => import('../pages/Auth/Login.vue') },
            { path: 'register', component: () => import('../pages/Auth/Register.vue') }
        ]
    },

    {
        path: '/general',
        component: () => import('../layouts/GeneralLayout.vue'),
        children: [
            { path: '', component: () => import('../pages/General/GeneralView.vue') }
        ]
    },

    // Área do cliente
    {
        path: '/client',
        component: () => import('../layouts/ClientLayout.vue'),
        children: [
            { path: '', component: () => import('../pages/Clients/ClientView.vue') }
        ]
    },
    /*
    // Área do admin
    {
        path: '/admin',
        component: () => import('../layouts/AdminLayout.vue'),
        children: [
            { path: '', component: () => import('../pages/Admin/Dashboard.vue') },
            { path: 'agenda', component: () => import('../pages/Admin/Agenda.vue') },
            { path: 'comissions', component: () => import('../pages/Admin/Comissions.vue') },
            { path: 'services', component: () => import('../pages/Admin/Services.vue') },
            { path: 'attendants', component: () => import('../pages/Admin/Attendants.vue') },
            { path: 'clients', component: () => import('../pages/Admin/Clients.vue') },
            { path: 'categories', component: () => import('../pages/Admin/Categories.vue') },
            { path: 'products', component: () => import('../pages/Admin/Products.vue') },
            { path: 'settings', component: () => import('../pages/Admin/Settings.vue') }
        ]
    },
    */

    {
        path: '/:catchAll(.*)*',
        component: () => import('../pages/ErrorNotFound.vue')
    }
];

export default routes;
