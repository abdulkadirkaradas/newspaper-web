<template>
    <div class="main-layout-container">
        <Header></Header>

        <div class="d-flex justify-content-center">
            <Sidebar></Sidebar>

            <div class="news-flow-container">
                <NewsFlow v-if="showNewsFlow"></NewsFlow>
                <router-view v-else></router-view>
            </div>
        </div>
    </div>
</template>

<script>
import { computed } from "vue";
import { useRoute } from "vue-router";

import { useAuthStore } from "../../stores/authStore";
import Header from "./partials/header.vue";
import Sidebar from "./partials/sidebar.vue";
import NewsFlow from "./flow/news.vue";

export default {
    props: {
    },
    setup() {
        const route = useRoute();
        const showNewsFlow = computed(() => route.meta.showNewsFlow);
        const showRouterView = computed(() => route.meta.showRouterView);

        return { showNewsFlow, showRouterView };
    },
    computed: {
        authStore: () => useAuthStore()
    },
    data() {
        return {
            initialData: window.initialData,
            sessionCheckInterval: null,
        };
    },
    mounted() {
        this.startSessionCheck();
    },
    beforeDestroy() {
        if (this.sessionCheckInterval) {
            clearInterval(this.sessionCheckInterval);
        }
    },
    methods: {
        startSessionCheck() {
            this.sessionCheckInterval = setInterval(async () => {
                try {
                    await axios.get("/auth/check-auth-token-exists");
                    this.authStore.setIsAuthTokenExists(true);
                } catch (error) {
                    if (error.response && error.response.data.status === 401) {
                        this.handleSessionExpired();
                    }
                }
            }, 5000);
        },
        handleSessionExpired() {
            this.authStore.setIsAuthTokenExists(false);
        },
    },
    provide() {
        return {
            appName: this.initialData.appName,
            news: JSON.parse(this.initialData.news),
            newsCategories: JSON.parse(this.initialData.newsCategories),
        };
    },
    components: {
        Header,
        Sidebar,
        NewsFlow,
    },
};
</script>


<style lang="scss">
* {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
}

html,
body {
    font-family: monospace;
    background-color: #f4f4f4;
}

header {
    width: 100%;
}

.main-layout-container {
    width: 100%;

    & .news-flow-container {
        flex: 1;
        padding: 20px;
        background-color: #fff;
        overflow-y: auto;
        margin-left: 250px;
        max-width: 1200px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    @media (min-width: 768px) {
        .sidebar {
            display: block;
        }
    }

    @media (max-width: 768px) {
        .sidebar.show {
            transform: translateX(0);
        }
    }
}
</style>