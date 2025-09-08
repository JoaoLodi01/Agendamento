import { boot } from 'quasar/wrappers';
import { LocalStorage } from 'quasar';
import axios from 'axios';

axios.defaults.withCredentials = true;

    const api = axios.create({ baseURL: process.env.API_URL });

    export default boot(({ app, router }) => {
        api.interceptors.request.use((config) => {

            const token = LocalStorage.getItem("auth_token");

            const publicAPIRoutes = [
            '/forgot-password',
            '/reset-password',
            '/auth/login',
            '/registers/create'

            ];

            const isPublic = publicAPIRoutes.some(route => config.url.includes(route));

            if (!token && !isPublic && LocalStorage.getItem("auth_token"))
            {
                console.log('token:', token);
                
                LocalStorage.remove("user_id");
                LocalStorage.remove("auth_token");
                router.replace({ path: '/login' });
            
                return Promise.reject(new Error("Usuário não autenticado"));
            }

            if (token) {
                config.headers.Authorization = `Bearer ${token}`;
            }

            return config;
        });

        api.interceptors.response.use((response) => response, (error) => {
            const publicAPIRoutes = [
                '/forgot-password',
                '/reset-password',
                '/auth/login',
                '/registers/create',

            ];
            
            const requestUrl = error.config?.url || '';
            const isPublic = publicAPIRoutes.some(route => requestUrl.includes(route));
            console.error(error)
            
            if(!isPublic && error?.response?.status === 401)
            {
                console.log('Vai pro login');
                const msg =
                    error.response?.data?.message ||
                    error.response?.data?.errorMessage ||
                    error.message ||
                    'Erro inesperado na resposta da API';

                LocalStorage.remove("user_id");
                LocalStorage.remove("auth_token");

                router.replace({ path: '/login' });
                
                console.log('LOGIN: ', LocalStorage.getItem("user_id"));
                
                return Promise.reject(error);

            } else {
            const msg =
                error.response?.data?.message ||
                error.response?.data?.errorMessage ||
                error.message ||
                'Erro inesperado na resposta da API';
                return Promise.reject(error); 

            };
        });

        app.config.globalProperties.$api = api;
    });

export { api };