import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import '../css/app.css';
import { createPinia } from 'pinia';
import { createI18n } from 'vue-i18n';

const i18n = createI18n({
  legacy: false,
  locale: 'zh-CN',
  fallbackLocale: "zh-CN",
  messages: {
    'zh-CN': {
      Welcome: '欢迎',
    },
    'en-US': {
      Welcome: 'Welcome 1',
    },
  }
});

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
  },
});
