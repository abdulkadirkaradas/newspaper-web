<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')

<body>
    <main>
        @include('layouts.partials.header')

        <div class="container">
            {!! render_page('dashboard.main', ['news' => $news]) !!}
        </div>

        @include('layouts.partials.footer')
    </main>
</body>

</html>
