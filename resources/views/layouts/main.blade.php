<!DOCTYPE html>
<html lang="en">
@include('layouts.partials.head')

<body>
    <div id="dashboard-container"></div>
</body>

<script>
    //This data passing method will be changed in the future
    window.initialData = @json($mainData);
</script>

</html>
