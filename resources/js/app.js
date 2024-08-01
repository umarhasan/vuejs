import './bootstrap';
import '../css/app.css';

import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';
import store from './store';

const appName =
    import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`,
        import.meta.glob('./Pages/**/*.vue', { eager: true })),
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        // Provide Vuex store and permissions globally
        app.use(plugin).use(store).use(ZiggyVue);

        const { user, permissions } = props.initialPage.props.auth;
        store.dispatch('initialize', { user, permissions });

        app.mount(el);
        return app;
    },
    progress: {
        color: '#4B5563',
    },
});