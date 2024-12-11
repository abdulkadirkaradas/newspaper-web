import "./bootstrap";
import { createApp } from "vue";
import Dashboard from "./components/dashboard/dashboard.vue";
import router from "./routes/index";
import dateMixin from "./mixins/dateMixin";
import { i18nVue } from "laravel-vue-i18n";
import { createPinia } from "pinia";

const pinia = createPinia();
createApp(Dashboard)
    .use(i18nVue, {
        resolve: async (lang) => {
            const langs = import.meta.glob("../../lang/*.json");
            return await langs[`../../lang/${lang}.json`]();
        },
    })
    .use(pinia)
    .use(router)
    .mixin(dateMixin)
    .mount("#dashboard-container");
