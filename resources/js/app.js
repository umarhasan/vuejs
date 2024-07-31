import './bootstrap';
import '../css/app.css';

import { createApp, h, provide } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const appName =
    import.meta.env.VITE_APP_NAME || 'Laravel';

createInertiaApp({
    title: (title) => `${title} - ${appName}`,
    resolve: (name) => resolvePageComponent(`./Pages/${name}.vue`,
        import.meta.glob('./Pages/**/*.vue', { eager: true })), // Eager loading for faster component availability
    setup({ el, App, props, plugin }) {
        const app = createApp({ render: () => h(App, props) });

        // Extracting permissions directly
        const { permissions } = props.initialPage.props.auth;

        app.use(plugin).use(ZiggyVue);

        // Providing auth and permissions globally
        app.provide('auth', props.initialPage.props.auth); // More efficient access
        app.provide('permissions', permissions);

        app.mount(el);
        return app;
    },
    progress: {
        color: '#4B5563',
    },
});