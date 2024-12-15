// stores/errorStore.js
import { defineStore } from "pinia";

export const useErrorStore = defineStore("errorStore", {
    state: () => ({
        message: null,
        toggleErrorMesage: false
    }),
    actions: {
        setError(message, bool) {
            this.message = message;
            this.toggleErrorMesage = bool;
        },
        clearError() {
            this.message = null;
            this.toggleErrorMesage = false;
        },
    },
});
