import axios from 'axios';
import { LocalStorage } from 'quasar';
import { boot } from 'quasar/wrappers';

axios.defaults.withCredentials = true;

    const api = axios.create({
        baseURL: process.env.API_URL,
    });

export default boot(({ app, router }) => {

    const publicAPIRoutes = [
        '/forgot-password',
        '/reset-password',
        '/auth/login',
        '/auth/register',
        '/registers/create',
    ];

    api.interceptors.request.use((config) => {
        const token = LocalStorage.getItem('auth_token');

        const url = new URL(config.url || '', process.env.API_URL).pathname;
        const isPublic = publicAPIRoutes.includes(url);

        if (!token && !isPublic) {
            LocalStorage.remove('user_id');
            LocalStorage.remove('auth_token');
            router.replace({ path: '/auth/login' });

            return Promise.reject(new Error('Usuário não autenticado'));
        }

        if (token) {
            config.headers.Authorization = `Bearer ${token}`;
        }

        return config;
    });

    api.interceptors.response.use(
        (response) => response, (error) => {
            const requestUrl = new URL(error.config?.url || '', process.env.API_URL).pathname;
            const isPublic = publicAPIRoutes.includes(requestUrl);

            if (!isPublic && error?.response?.status === 401) {
                LocalStorage.remove('user_id');
                LocalStorage.remove('auth_token');
                router.replace({ path: '/auth/login' });
                return Promise.reject(new Error('Usuário não autenticado'));
            }

            return Promise.reject(error);
        }
    );

    app.config.globalProperties.$api = api;
});

export { api };
