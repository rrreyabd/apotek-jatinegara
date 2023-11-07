<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
</head>
<body class="font-Inter relative">
    @include('user.components.navbar')
    
    @include('user.components.carousel')
    
    @auth
        @include('user.components.index.category')
        @include('user.components.index.last-purchased')
    @endauth
        
    @include('user.components.footer')
</body>

</html>