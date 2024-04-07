<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @stack('styles')

</head>

<body style="background-image: url('{{Storage::url('images/mainbackground.jpg')}}')" class="bg-cover">
    @include('layouts.navigation')
    <div class="container mx-auto bg-yellow-300 rounded-lg mt-5 mb-5 p-2">
        @yield('content')
    </div>
</body>
</html>
