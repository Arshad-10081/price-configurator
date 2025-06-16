<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Price Configurator</title>
    @livewireStyles
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
</head>
<body>
    <div class="container mx-auto py-4">
        {{ $slot }}
    </div>
    @livewireScripts
</body>
</html>
