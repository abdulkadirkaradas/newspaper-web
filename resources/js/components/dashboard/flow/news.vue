<template>
    <div class="news-flow">
        <div class="row row-cols-xl-3 row-cols-lg-3 row-cols-md-2 row-cols-1">
            <div class="news" v-for="(value, key) in trimmedNews" :key="key">
                <div :class="`section-${key}`" class="feature col post-section p-3 bg-light">
                    <div class="post-title text-center fw-bold">
                        {{ value.title }}
                    </div>
                    <div class="post-content">
                        {{ value.content }}
                        <div class="show-more-button text-primary">{{ $t('dashboard.showMore') }}</div>
                    </div>
                    <div class="post-footer col-12 d-flex">
                        <div class="post-creation-date col-6 text-center" style="border-right: none;">
                            {{ convertUTCDateToLocalDate(value.created_at) }}
                        </div>
                        <div class="post-author col-6 text-center">
                            <!-- TODO: This value should be author name -->
                            {{ value.title }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    inject: ['news'],
    computed: {
        trimmedNews() {
            return this.news.map(item => {
                return { ...item, content: item.content.substring(0, 300) }
            });
        }
    }
}
</script>

<style lang="scss">
.news-flow {
    & .post-title
    .post-content,
    .post-author,
    .post-creation-date {
        border: 1px solid black;
        /* Border attribute will be remove after page styling completed */
        padding: 5px;
    }

    & .post-content,
    .post-author,
    .post-creation-date {
        border: 1px solid black;
        margin-top: 3px;
    }

    & .show-more-button {
        cursor: pointer;
    }

    & .show-more-button:hover {
        color: #fff;
        text-decoration: underline;
    }
}
</style>