// store/index.js
import { createStore } from 'vuex';

export default createStore({
    state() {
        return {
            user: null,
            permissions: []
        };
    },
    mutations: {
        setAuth(state, { user, permissions }) {
            state.user = user;
            state.permissions = permissions;
        }
    },
    getters: {
        hasPermission: (state) => (permission) => {
            return state.permissions.includes(permission);
        }
    }
});