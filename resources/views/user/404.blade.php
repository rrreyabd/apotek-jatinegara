<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>404</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
    
</head>
<body class="font-Roboto">
    <div class="flex justify-center items-center h-screen w-screen flex-col gap-4">
        <p class="font-bold text-9xl animate-character">Oops!</p>
        <p class="font-Inter text-2xl font-extrabold">404 - HALAMAN TIDAK TERSEDIA</p>
        <p class="font-medium w-96 text-center">Halaman yang anda cari mungkin sudah dihapus, berubah penamaan, atau sedang tidak tersedia.</p>

        <a href="/" class="px-8 py-3 bg-mainColor font-semibold text-lg rounded-full text-white shadow-md shadow-semiBlack">Kembali ke Website</a>
    </div>
</body>
</html>