<template>
    <aside class="sidebar text-white bg-dark" style="width: 250px; height: 100vw; position: fixed; left: 0;">
        <div class="user-image">
            {{ userInformations ?? '' }}
            <img src="">
        </div>
        <div class="user-informations"></div>
        <div class="user-badges"></div>
        <div class="user-rewards"></div>
        <div class="user-news-informations"></div>
    </aside>
</template>

<script>
export default {
    inject: ['userInformation'],
}
</script>

<style lang="scss">
.sidebar {
    width: 250px;
    background-color: #2d2d2d;
    color: #fff;
    padding: 20px;
    position: relative;
    height: calc(100vh - 60px);
    overflow-y: auto;

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