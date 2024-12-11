<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')

<body>
    <div id="dashboard-container"></div>
</body>

<script>
    window.initialData = @json($mainData);
</script>

</html>
