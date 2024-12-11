<template>
    <header class="main-header-container p-3 bg-dark text-white">
        <span id="menu-toggle-btn" class="menu-toggle d-lg-none" @click="menuToggleButton()"
            style="display: none; background-color: unset; border: 1px solid white;">☰</span>
        <div class="container">
            <div class="col-12 d-flex flex-wrap align-items-center justify-content-center justify-content-lg-start">
                <div class="col-lg-1 text-start">
                    <a @click="navigateTo('/')" class="col-2 d-flex align-items-center mb-2 mb-lg-0 text-white text-decoration-none">
                        <span>{{ appName }}</span>
                    </a>
                </div>

                <div class="nav col-4 mb-md-0">
                    <div v-for="(value, key) in newsCategories" :key="key">
                        <a href="#" :class="`category-${key}`" class="header-category text-white text-decoration-none"
                            style="margin-left: 10px;">
                            <span class="text-white">n\{{ value.name }}</span>
                        </a>
                    </div>
                </div>

                <div class="col-4">
                    <input type="search" class="form-control form-control-dark" placeholder="Search..."
                        aria-label="Search" />
                </div>

                <div class="col-lg-3">
                    <!-- TODO: User quick actions should be shown when the user click icon -->
                    <div class="user-icon-container text-end" v-if="isAuthTokenExists">
                        <div id="user-icon"  @click="logout" class="d-flex align-items-center justify-content-center"
                            style="width: 32px; height: 32px; float: right; cursor: pointer;">
                            <i class="fa-solid fa-circle-user fa-2xl"></i>
                        </div>
                    </div>
                    <div class="text-end" v-else>
                        <!-- TODO: Login should be pop-up so that user can easily log in -->
                        <a @click="navigateTo('/login')" class="btn btn-outline-light me-2">Login</a>
                        <!-- TODO: Register process must be maded with pop-up -->
                        <a @click="navigateTo('/register')" class="btn btn-warning">Sign-up</a>
                    </div>
                </div>
            </div>
        </div>
    </header>
</template>

<script>
import axios from 'axios';
import { useAuthStore } from '../../../stores/authStore';

export default {
    inject: ['appName', 'newsCategories'],
    computed: {
        authStore: () => useAuthStore(),
        isAuthTokenExists: () => useAuthStore().isAuthTokenExists
    },
    methods: {
        async logout() {
            const response = await axios.post('login/logout');

            if (response.status === 200) {
                this.authStore.setIsAuthTokenExists(false);
                this.$router.push('/');
            }
        },
        menuToggleButton() {
            const sidebar = $('.sidebar');
            const newsFlowContainer = $('.news-flow-container');
            let sidebarVisibility = sidebar.css('display');

            sidebar.css('display', sidebarVisibility === 'block' ? 'none' : 'block');
            newsFlowContainer.css('margin-left', sidebarVisibility === 'block' ? 0 : 250);
        },
        navigateTo(route) {
            this.$router.push(route);
        }
    }
}
</script>

<style lang="scss">
.main-header-container {
    @media (max-width: 768px) {
        #menu-toggle-btn {
            display: block !important;
        }

        .menu-toggle {
            display: block;
            position: fixed;
            top: 15px;
            left: 15px;
            background-color: #2d2d2d;
            color: #fff;
            border: none;
            font-size: 1.5rem;
            cursor: pointer;
            z-index: 1000;
        }
    }
}
</style>