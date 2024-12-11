import { defineStore } from "pinia";

export const useAuthStore = defineStore('authStore', {
    state: () => ({
        isAuthTokenExists: null
    }),
    actions: {
        setIsAuthTokenExists(value) {
            this.isAuthTokenExists = value;
        }
    },
    getters: {
        getIsAuthTokenExists: (state) => {
            return state.isAuthTokenExists;
        }
    }
});