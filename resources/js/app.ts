import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import '../css/app.css';
import { createPinia } from 'pinia';
import i18n from '@/i18n';
import '@/plugins/axios';
import { useAuthStore } from '@/stores/authStore';

createInertiaApp({
  title: (title) => `${title} - ` + import.meta.env.VITE_APP_NAME,
  resolve: async (name) => {
    const page = await resolvePageComponent(`./Pages/${name}.vue`, import.meta.glob('./Pages/**/*.vue'));
    return (page as any).default || page;
  },
  setup({ el, App, props, plugin }) {
    const app = createApp({ render: () => h(App, props) });

    const pinia = createPinia()

    app.use(pinia)

    app.use(plugin);

    app.use(i18n);

    app.mount(el);

    // 初始化认证状态
    const authStore = useAuthStore();
    authStore.initAuth();
  },
});
