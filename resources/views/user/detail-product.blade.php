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

            <div class="md:flex gap-8 md:grid-cols-2">
                {{-- product --}}
                <div class="md:w-1/2 p-5">
                    <img src="{{ asset('img/obat1.jpg/') }}" alt="">
                </div>

                <div class="p-2 md:w-1/2">
                    <span class="bg-red-500 rounded-md px-2 py-1 text-white text-sm font-semibold">Resep</span>
                    <p class="font-semibold text-2xl my-3">Paracetamol 500 mg 10 Kaplet</p>
                    <p class="font-semibold text-2xl text-orange-400 my-2">Rp 50.000</p>
                    <p class="text-lg my-3 text-gray-500">
                        Paracetamol tablet merupakan obat yang dapat digunakan untuk meringankan rasa sakit
                        pada sakit kepala, sakit gigi, dan menurunkan demam.
                    </p>
                    <p class="text-lg my-1">
                        Stok : 10
                    </p>
                    <div class="flex gap-4 my-3">
                        <p class="text-lg font-semibold">
                            Jumlah :
                        </p>
                        <div class="flex gap-3 ps-5">
                            <div class="sm:flex sm:grid-cols-3 gap-4 justify-center">

                                <button
                                    class="shadow-lg inline-flex items-center justify-center p-1 text-sm font-medium h-6 w-6 text-gray-500 bg-white border border-gray-300 rounded-md focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200" type="
                                    button">
                                    <i class="fa-solid fa-minus"></i>
                                </button>
                                <div>
                                    <input type="number"
                                        class="shadow-lg bg-gray-50 w-14 border border-gray-300 text-gray-900 text-sm rounded-md block px-2.5 py-1"
                                        placeholder="1">
                                </div>
                                <button
                                    class="shadow-lg inline-flex items-center justify-center h-6 w-6 p-1 text-sm font-medium text-gray-500 bg-white border border-gray-300 rounded-md focus:outline-none hover:bg-gray-100 focus:ring-4 focus:ring-gray-200" type="
                                    button">
                                    <i class="fa-solid fa-plus"></i>
                                </button>

                            </div>
                        </div>
                    </div>

                    <a href=""
                        class="rounded-lg shadow-md flex justify-center items-center h-[40px] px-6 text-white text-lg bg-mainColor my-5">
                        <i class="pe-2">icon</i>
                        Tambahkan ke keranjang</a>
                </div>
            </div>

            {{-- line --}}
            <div class="w-fill shadow border border-neutral-200"></div>

            <div class="gap-8 md:grid-cols-2 py-7">
                <div class="flex items-start">
                    <p class="  rounded-lg p-1.5 px-4 mb-5 text-white text-lg font-semibold bg-mainColor">Detail Produk</p>
                </div>

                <table>
                    <tr>
                        <td class="pt-3">Manufaktur</td> 
                        <td class="ps-16">Generic Manufacturer</td>
                    </tr>
                    <tr>
                        <td class="pt-3">Golongan Obat</td> 
                        <td class="ps-16">Obat Bebas (Hijau)</td>
                    </tr>
                    <tr>
                        <td class="pt-3">Kategori Obat</td> 
                        <td class="ps-16">Obat Demam</td>
                    </tr>
                    <tr>
                        <td class="pt-3">Tanggal Kadaluwarsa</td>
                        <td class="ps-16">24 Febuari 2025</td>
                    </tr>
                    <tr>
                        <td class="pt-3">No. Izin Edar (BPOM)</td>
                        <td class="ps-16">GBL7802318304A2</td>
                    </tr>
                    <tr>
                        <td class="pt-3">Efek Samping</td>
                        <td class="ps-16">Mengantuk</td>
                    </tr>
                </table>
            </div>

            {{-- line --}}
            <div class="w-fill shadow border border-neutral-200"></div>

            <div class="gap-8 md:grid-cols-2 py-4">
                <div class="py-2">
                    <div class="flex items-start">
                        <p class="rounded-lg p-1.5 px-4 text-white text-lg font-semibold bg-mainColor">Dosis</p>
                    </div>
                    <p class="py-3 text-gray-500"> Dewasa: 1-2 kaplet, 3-4 kali per hari. Penggunaan maximum 8
                        kaplet per hari.
                        Anak 7-12 tahun : 0.5 - 1 kaplet, 3-4 kali per hari. Penggunaan maximum 4 kaplet per hari.
                    </p>
                </div>
                <div class="py-2">
                    <div class="flex items-start">
                        <p class="rounded-lg p-1.5 px-4 text-white text-lg font-semibold bg-mainColor">Indikasi Umum
                        </p>
                    </div>
                    <p class="py-3 text-gray-500"> Obat ini digunakan untuk meredakan nyeri ringan hingga sedang
                        seperti sakit
                        kepala, sakit gigi, nyeri otot, serta menurunkan demam.</p>
                </div>
                <div class="py-2">
                    <div class="flex items-start">
                        <p class="rounded-lg p-1.5 px-4 text-white text-lg font-semibold bg-mainColor">Perhatian</p>
                    </div>
                    <p class="py-3 text-gray-500"> Hati-hati penggunaan pada pasien dengan gagal ginjal, gangguan
                        fungsi hati,
                        dan alergi atau mengalami hipersensitivitas terhadap paracetamol.</p>
                </div>
            </div>
        </div>
    </div>
    @include('user.components.footer')
</body>

</html>