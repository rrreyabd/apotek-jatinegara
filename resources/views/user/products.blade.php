<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Produk</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
</head>
<body class="font-Trip">
    @include('user.components.secondNavbar');

    <div class="flex flex-col items-center mb-8">
        <div class="w-[80vw] h-[100vh] mt-8 flex gap-8">
            <div class=" w-[30%] p-4">
                <div class="h-full w-full flex gap-4 flex-col">
                    <div class="flex items-center text-mainColor justify-between">
                        <div class="flex gap-2">
                            <i class="fa-solid fa-sliders border-2 border-mainColor p-1 rounded-md"></i>
                            <p class="text-xl font-TripBold">Filter</p>
                        </div>
                        <button onclick="" class="h-full flex items-center text-darkGrey text-xl pr-2">
                            <i class="fa-solid fa-minus"></i>
                        </button>
                    </div>

                    <hr class="border-1 border border-[#cccccc]">

                    <div class="bg-lightGrey w-full h-[200px] rounded-md shadow-md shadow-semiBlack">
                        <select name="" id="" @selected(true)>
                            <option value="">Populer</option>
                            <option value="">Nama A-Z</option>
                            <option value="">Nama Z-A</option>
                            <option value="">Harga Tinggi - Rendah</option>
                            <option value="">Harga Rendah - Tinggi</option>
                        </select>
                    </div>

                </div>
            </div>
            <div class="bg-blue-600 w-[70%]"></div>

            {{-- FILTER PRODUK START --}}
        
            {{-- FILTER PRODUK END --}}
        </div>
    </div>

    @include('user.components.footer');
</body>
</html>