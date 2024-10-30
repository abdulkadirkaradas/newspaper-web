<?php $news = json_decode($news); ?>

<style>
    .post-title,
    .post-content,
    .post-author,
    .post-creation-date {
        border: 1px solid black;
        /* Border attribute will be remove after page styling completed */
        padding: 5px;
    }

    .post-content, .post-author, .post-creation-date {
        margin-top: 3px;
    }

    .show-more-button {
        cursor: pointer;
    }

    .show-more-button:hover {
        color: #fff;
        text-decoration: underline;
    }
</style>

<div class="timeline">
    <div class="row row-cols-xl-3 row-cols-lg-3 row-cols-md-2 row-cols-1">
        @foreach ($news as $key => $new)
            <div class="feature col post-section section<?= $key ?> p-3 bg-light">
                <div class="post-title text-center fw-bold">
                    {{ $new->title }}
                </div>
                <div class="post-content">
                    {{ substr($new->content, 0, 300) }}
                    <div class="show-more-button text-primary">{{ __('dashboard.showMore') }}</div>
                </div>
                <div class="post-footer col-12 d-flex">
                    <div class="post-creation-date col-6 text-center" style="border-right: none;">
                        {{ convertUTCDateToLocalDate($new->created_at) }}
                    </div>
                    <div class="post-author col-6 text-center">
                        {{ $new->title }}
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
