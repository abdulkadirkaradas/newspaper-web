<aside class="sidebar text-white bg-dark" style="position: fixed; left: 0; margin-top: 70px;">
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
