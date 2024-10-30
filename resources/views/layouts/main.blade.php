<!DOCTYPE html>
<html lang="en">
    @include('layouts.partials.head')
<body>
    @include('layouts.partials.header')

    <div class="container">
        {!! render_page('dashboard.main') !!}
    </div>

    @include('layouts.partials.footer')
</body>
</html>