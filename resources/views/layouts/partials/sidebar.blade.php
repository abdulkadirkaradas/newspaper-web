<aside class="sidebar text-white bg-dark" style="position: fixed; left: 0; margin-top: 70px;">
    <div class="user-image">
        {{ json_encode($userInformations ?? '') }}
        <img src="">
    </div>
    <div class="user-informations"></div>
    <div class="user-badges"></div>
    <div class="user-rewards"></div>
    <div class="user-news-informations"></div>
</aside>

<script>
    $(document).ready(setSidebarMargin);
    $(window).on('resize', setSidebarMargin);

    function setSidebarMargin() {
        const header = $('header');
        const sidebar = $('aside');

        sidebar.css('margin-top', header.outerHeight());
    }
</script>
