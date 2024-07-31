import './bootstrap';
import '../css/app.css';
import store from './store';
import { createApp, h } from 'vue';
import { createInertiaApp } from '@inertiajs/inertia-vue3';
import { resolvePageComponent } from 'laravel-vite-plugin/inertia-helpers';
import { ZiggyVue } from '../../vendor/tightenco/ziggy';

const app = createApp(App);

// Simulate fetching auth data, typically you would fetch this from your API or session
store.commit('setAuth', {
    user: { name: 'John Doe', email: 'john@example.com' },
    permissions: ['user list', 'permission list', 'role list', 'post list']
});

app.use(store).mount('#app');