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
                <svg xmlns="http://www.w3.org/2000/svg" class="pe-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
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
                <div class="w-fit rounded-lg border-2 border-mainColor p-1.5 px-3 mt-7" aria-orientation="vertical" aria-labelledby="menu-button" tabindex="-1">
                    <select name="" id="" @selected(true) class="outline-none">
                        <option value="">Pesanan Berhasil</option>
                        <option value="">Pesanan Gagal</option>
                        <option value="">Menunggu Pengembalian</option>
                        <option value="">Menunggu Konfirmasi</option>
                    </select>
                </div>

                {{-- table --}}
                <div class="overflow-x-auto">
                    {{-- <div class="flex justify-between items-center md:grid-cols-5 w-full mt-7 mb-3 p-3">
                        <p class="font-semibold">No. Invoice</p>
                        <p class="font-semibold">Tanggal Belanja</p>
                        <p class="font-semibold">Keterangan</p>
                        <p class="font-semibold">Status</p>
                        <p class="font-semibold">Total Belanja</p>
                    </div>
                    <div class="flex justify-between items-center md:grid-cols-5 w-full p-3 shadow-lg rounded-lg border-[1px] border-black">
                        <p>INV-00012323</p>
                        <p>19 September 2023</p>
                        <a href="" class="">Lihat Detail</a>
                        <p class="bg-green-700 px-4 py-1 rounded-lg text-white font-semibold">Pesanan Berhasil</p>
                        <p>Rp 50.000</p>
                    </div> --}}

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
                            <tr class="p-3 shadow-lg rounded-lg border-[1px] border-black">
                                <th>INV-00012323</th>
                                <th class="font-light">19 September 2023</th>
                                <th><a href="" class="text-blue-600 underline font-light">Lihat Detail</a></th>
                                <th>
                                    @if(false)
                                    <p class="bg-green-700 py-1 rounded-lg text-white font-semibold">Pesanan Berhasil</p>
                                    @elseif(false)
                                    <p class="bg-red-600 py-1 rounded-lg text-white font-semibold">Pesanan Berhasil</p>
                                    @elseif(false)
                                    <p class="bg-secondaryColor py-1 rounded-lg text-white font-semibold">Menunggu Pengembalian</p>
                                    @else
                                    <p class="bg-secondaryColor py-1 rounded-lg text-white font-semibold">Menunggu Konfirmasi</p>
                                    @endif
                                </th>
                                <th>Rp 50.000</th>
                            </tr>
                        </tbody>
                    </table>

                </div>
            </div>
        </div>
    </div>

    @include('user.components.footer')
</body>

</html>