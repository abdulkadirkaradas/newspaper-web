<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>@lang('dashboard.title')</title>

{{-- Vue Components --}}
@vite(['resources/js/app.js'])

<!-- Bootstrap Styles -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

{{-- Fontawesome Library --}}
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" rel="stylesheet"/>

{{-- Main Style Files --}}
@vite(['resources/sass/app.scss', 'resources/css/app.css'])

<!-- Bootstrap Libraries -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- jQuery Libraries -->
<script src="https://code.jquery.com/jquery-3.7.1.js"></script>
<script src="https://code.jquery.com/ui/1.13.3/jquery-ui.js"></script>

{{-- Parsley.js Library --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/parsley.js/2.9.2/parsley.js"></script>