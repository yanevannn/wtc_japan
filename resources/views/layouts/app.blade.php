<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'WTC JAPAN')</title>
    @vite(['resources/css/app.css', 'resources/js/swal.js'])
</head>
<body>
    @yield('content')
    @include('components.alert')
</body>
</html>