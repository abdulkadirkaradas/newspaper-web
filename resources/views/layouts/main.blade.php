<!DOCTYPE html>
<html lang="en">
    @include('layouts.partials.head')
<body>
    @include('layouts.partials.header')

    <div class="container">
        @yield('content')
    </div>

    @include('layouts.partials.footer')
</body>
</html>