<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cara Belanja</title>
    @livewireStyles
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    <style>
        td {
            height: 30px;
        }
    </style>

</head>
<body class="font-Inter w-full">
    @include('user.components.navbar')

    {{-- NAV MENU --}}
    <div class="w-full h-12 flex">
        <a href="s&k" class="w-1/2 h-full text-center flex justify-center items-center text-lg hover:brightness-90 duration-100 ease-in-out bg-mainColor text-white font-bold">Syarat dan Ketentuan</a>
        <a href="cara-belanja" class="w-1/2 h-full text-center flex justify-center items-center text-lg hover:brightness-75 brightness-90 duration-100 ease-in-out bg-white text-black font-bold">Cara Belanja</a>
    </div>
    {{-- NAV MENU --}}

    {{-- MAIN --}}
    <main class="px-56 py-8 h-fit text-center">
        <p class="font-bold text-3xl">TATA CARA BELANJA DI APOTEK JATI NEGARA</p>
        <img src="{{ asset('img/cara-belanja.png')}}" class="w-full" draggable="false" alt="">
    </main>
    {{-- MAIN --}}

    @include('user.components.footer')
</body>
</html>