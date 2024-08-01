import { createStore } from 'vuex';

export default createStore({
    state: {
        user: null,
        permissions: [],
        permissionsWithNames: [],
    },
    mutations: {
        SET_USER(state, user) {
            state.user = user;
        },
        SET_PERMISSIONS(state, permissions) {
            state.permissions = permissions.map(permission => permission.name);
            state.permissionsWithNames = permissions;
        },
        UPDATE_PERMISSIONS(state, permissions) {
            state.permissions = permissions.map(permission => permission.name);
            state.permissionsWithNames = permissions;
        },
    },
    actions: {
        initialize({ commit }, { user, permissions }) {
            commit('SET_USER', user);
            commit('SET_PERMISSIONS', permissions);
        },
        updatePermissions({ commit }, permissions) {
            commit('UPDATE_PERMISSIONS', permissions);
        },
    },
    getters: {
        user: (state) => state.user,
        permissions: (state) => state.permissions,
        permissionsWithNames: (state) => state.permissionsWithNames,
    },
});