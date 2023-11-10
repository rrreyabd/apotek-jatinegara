<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Riwayat Pesanan</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
</head>

<body class="font-Trip">
    @include('user.components.secondNavbar')

    <div class="flex flex-col items-center mb-8">

        <div class="w-[70vw] mt-8 flex flex-col">
            <div class="flex gap-4">
                {{-- back button --}}
                <button onclick=""
                    class="flex justify-start items-center rounded-3xl shadow-md h-[40px] px-3 text-center text-lg text-gray-500 font-semibold">
                    <svg xmlns="http://www.w3.org/2000/svg" class="pe-1" width="24" height="24" viewBox="0 0 24 24"
                        stroke-width="2" stroke="currentColor" fill="none">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M9 14l-4 -4l4 -4"></path>
                        <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                    </svg>
                    Kembali</button>
            </div>

            <div class="my-7">
                <p class="text-3xl font-semibold">Riwayat Pesanan</p>

                {{-- search --}}
                <form action="" class="relative my-3">
                    <input type="text" placeholder="19 September"
                        class="px-3 py-2 w-full rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack">
                    <button class="absolute right-2 top-2">
                        <i class="fa-solid fa-magnifying-glass text-2xl text-secondaryColor"></i>
                    </button>
                </form>

                {{-- dropdown filter --}}
                <div class="w-fit rounded-lg border-2 border-mainColor p-1.5 px-3 mt-7">
                    <select name="" id="" @selected(true) class="outline-none">
                        <option disabled selected>Status Pesanan</option>
                        <option value="">Pesanan Berhasil</option>
                        <option value="">Pesanan Gagal</option>
                        <option value="">Menunggu Pengembalian</option>
                        <option value="">Menunggu Konfirmasi</option>
                    </select>
                </div>

                {{-- table --}}
                <div class="overflow-x-auto">
                    <table class="w-full mt-5">
                        <thead>
                            <tr>
                                <th>No. Invoice</th>
                                <th>Tanggal Belanja</th>
                                <th>Keterangan</th>
                                <th>Status</th>
                                <th>Total Belanja</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="p-3 shadow-lg rounded-lg border-[1px] border-black h-[55px]">
                                <th>INV-00012323</th>
                                <th class="font-light">19 September 2023</th>
                                <th><a href="" class="text-blue-600 underline font-light">Lihat Detail</a></th>
                                <th class="py-3 flex justify-center items-center">
                                    @if(false)
                                    <p class="bg-green-700 py-1 px-4 rounded-lg text-white font-semibold">Pesanan
                                        Berhasil</p>
                                    @elseif(false)
                                    <p class="bg-red-600 py-1 px-4 rounded-lg text-white font-semibold">Pesanan Gagal
                                    </p>
                                    @elseif(false)
                                    <p class="bg-secondaryColor py-1 px-4 rounded-lg text-white font-semibold">Menunggu
                                        Pengembalian</p>
                                    @else
                                    <p class="bg-secondaryColor py-1 px-4 rounded-lg text-white font-semibold">Menunggu
                                        Konfirmasi</p>
                                    @endif
                                </th>
                                <th>Rp 50.000</th>
                            </tr>
                        </tbody>
                    </table>


                    {{-- pagination --}}
                    <div class="w-full flex justify-end items-center h-[20vh]">
                        <div class="flex gap-8 items-center">
                            <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out">
                                <i class="fa-solid fa-chevron-left"></i>
                            </a>
                            <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out">1</a>
                            <!-- tambahkan class pageActive untuk page yang sedang dibuka -->
                            <a href=""
                                class="font-normal hover:font-semibold transition duration-300 ease-in-out pageActive">2</a>
                            <a href=""
                                class="font-normal hover:font-semibold transition duration-300 ease-in-out ">3</a>
                            <p class="unselectable">...</p>
                            <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out">7</a>
                            <a href="" class="font-normal hover:font-semibold transition duration-300 ease-in-out">
                                <i class="fa-solid fa-chevron-right"></i>
                            </a>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    @include('user.components.footer')
</body>

</html>