<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')

<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        background-color: #f4f4f4;
    }

    .main-layout-container {
        width: 100%;
    }

    header {
        width: 100%;
    }

    .sidebar {
        width: 250px;
        background-color: #2d2d2d;
        color: #fff;
        padding: 20px;
        position: relative;
        height: calc(100vh - 60px);
        overflow-y: auto;
    }

    .timeline-container {
        flex: 1;
        padding: 20px;
        background-color: #fff;
        overflow-y: auto;
        margin: 70px 0 0 250px;
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
        #menu-toggle-btn {
            display: block !important;
        }

        .sidebar.show {
            transform: translateX(0);
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
</style>

<body>
    <main>
        <div class="main-layout-container">
            @include('layouts.partials.header')

            <div class="d-flex justify-content-center">
                @include('layouts.partials.sidebar')

                <div class="timeline-container">
                    @include('dashboard.main')
                </div>
            </div>
        </div>

        @include('layouts.partials.footer')
    </main>
</body>

</html>

<script>
    $(document).ready(setTimelineContainerMargin);
    $(window).on('resize', setTimelineContainerMargin);

    function setTimelineContainerMargin() {
        const header = $('header');
        const sidebar = $('aside');
        let timelineContainer = $('.timeline-container');

        timelineContainer.css({
            "margin-top": header.outerHeight(),
            "margin-left": sidebar.outerWidth()
        });
    }
</script>