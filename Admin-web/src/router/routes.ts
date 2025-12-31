import type { RouteRecordRaw } from 'vue-router';

const routes: RouteRecordRaw[] = [
    {
        path: '/',
        component: () => import('../layouts/GeneralLayout.vue'),
        children: [
            { path: '', component: () => import('../pages/General/GeneralView.vue') },
            { path: 'about', component: () => import('../pages/General/AboutView.vue') },
            { path: 'contact', component: () => import('../pages/General/ContactView.vue') },
        ]
    },

    // Área do cliente
    {
        path: '/client',
        component: () => import('../layouts/ClientLayout.vue'),
        children: [
            { path: 'default', component: () => import('../pages/Clients/ClientView.vue') },
            { path: 'reservation', component: () => import('../pages/Clients/ReservationView.vue') }
        ]
    },

    // Rota de autenticação
    {
        path: '/auth',
        component: () => import('../layouts/AuthLayout.vue'),
        children: [
            { path: 'login', component: () => import('../pages/Auth/Login.vue') },
            { path: 'register', component: () => import('../pages/Auth/Register.vue') },
            { path: 'reset-password', component: () => import('../pages/Auth/ResetPassword.vue') },
        ]
    },

    // Área do admin
    {
        path: '/admin',
        component: () => import('../layouts/AdminLayout.vue'),
        
        children: [
            { path: 'dashboard', component: () => import('../pages/Dashboard/MainDashboard.vue') },
            { path: 'agenda', component: () => import('../pages/Agenda/MainAgenda.vue') },
            { path: 'agenda/register', component: () => import('../pages/Agenda/RegisterAgenda.vue') },
            { path: 'comissions', component: () => import('../pages/Comissions/MainComissions.vue') },
            { path: 'services', component: () => import('../pages/Services/MainServices.vue') },
            { path: 'services/register', component: () => import('../pages/Services/RegisterServices.vue') },
            { path: 'attendants', component: () => import('../pages/Attendants/MainAttendants.vue') },
            { path: 'attendants/register', component: () => import('../pages/Attendants/RegisterAttendants.vue') },
            { path: 'attendants/register/hours', component: () => import('../pages/Attendants/RegisterHours.vue') },
            { path: 'clients', component: () => import('../pages/Clients/MainClients.vue') },
            { path: 'clients/register', component: () => import('../pages/Clients/RegisterClients.vue') },
            { path: 'categories', component: () => import('../pages/Categories/MainCategories.vue') },
            { path: 'categories/register', component: () => import('../pages/Categories/RegisterCategories.vue') },
            { path: 'products', component: () => import('../pages/Products/MainProducts.vue') },
            { path: 'products/register', component: () => import('../pages/Products/RegisterProducts.vue') },
            { path: 'settings', component: () => import('../pages/Settings/MainSettings.vue') },
            { path: 'license', component: () => import('../pages/License/MainLicense.vue') }
        ]
    },

    {
        path: '/:catchAll(.*)*',
        component: () => import('../pages/ErrorNotFound.vue')
    }
];

export default routes;
