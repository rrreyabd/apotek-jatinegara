<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @livewireStyles
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
</head>

@if (session('status') == 'pembayaran-berhasil')
<body class="font-Inter relative h-[100vh] overflow-hidden">
@elseif(session('status') == 'pembayaran-gagal')
<body class="font-Inter relative h-[100vh] overflow-hidden">
@else
<body class="font-Inter relative">
@endif

    @include('user.components.navbar')
    
    @include('user.components.carousel')
    
    @include('user.components.category')
    
    @auth
        @include('user.components.last-purchased')
    @endauth
    
    @include('user.components.banyak-dicari')

    @include('user.components.footer')
    
    @livewireScripts
</body>
</html>