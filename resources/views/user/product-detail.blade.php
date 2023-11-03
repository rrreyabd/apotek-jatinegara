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
                    class="flex justify-start items-center rounded-3xl shadow-md h-[40px] px-3 text-center text-lg font-semibold">
                    <i class="pe-2">icon</i>
                    Kembali</button>
            </div>

            <div class="md:flex gap-8 md:grid-cols-2">
                {{-- product --}}
                <div class="md:w-screen">
                    <img src="{{ asset('img/obat1.jpg/') }}" alt="">
                </div>

                <div class="p-2">
                    <span class="bg-red-500 rounded-md px-2 py-1 text-white text-sm font-semibold">Resep</span>
                    <p class="font-semibold text-2xl my-3">Paracetamol 500 mg 10 Kaplet</p>
                    <p class="font-semibold text-2xl text-orange-400 my-2">Rp 50.000</p>
                    <p class="text-lg my-3">
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
                            <p>tes</p>
                            <p>tes</p>
                            <p>tes</p>
                        </div>
                    </div>

                    <a href=""
                        class="rounded-lg shadow-md flex justify-center items-center h-[40px] px-6 text-white text-lg bg-mainColor my-3">
                        <i class="pe-2">icon</i>
                        Tambahkan ke keranjang</a>
                </div>
            </div>

            {{-- line --}}
            <div class="w-fill shadow border border-neutral-200"></div>

            <div class="gap-8 md:grid-cols-2 py-7">
                <div class="flex items-start">
                    <p class="rounded-lg p-1.5 px-4 text-white text-lg font-semibold bg-mainColor">Detail Produk</p>
                </div>
                <div class="flex grid-cols-2 gap-16 py-4">
                    <div>
                        <p class="py-1.5">Manufaktur</p>
                        <p class="py-1.5">Golongan Obat</p>
                        <p class="py-1.5">Kategori Obat</p>
                        <p class="py-1.5">Tanggal Kadaluwarsa</p>
                        <p class="py-1.5">No. Izin Edar (BPOM)</p>
                        <p class="py-1.5">Efek Samping</p>
                    </div>
                    <div>
                        <p class="py-1.5">Generic Manufacturer</p>
                        <p class="py-1.5">Obat Bebas (Hijau)</p>
                        <p class="py-1.5">Obat Demam</p>
                        <p class="py-1.5">24 Febuari 2025</p>
                        <p class="py-1.5">GBL7802318304A2</p>
                        <p class="py-1.5">Generic Manufacturer</p>
                    </div>
                </div>
                
                {{-- line --}}
                <div class="w-fill shadow border border-neutral-200"></div>

                <div class="gap-8 md:grid-cols-2 py-4">
                    <div class="py-2">
                        <div class="flex items-start">
                            <p class="rounded-lg p-1.5 px-4 text-white text-lg font-semibold bg-mainColor">Dosis</p>
                        </div>
                        <p class="py-3"> Dewasa: 1-2 kaplet, 3-4 kali per hari. Penggunaan maximum 8 kaplet per hari.
                            Anak 7-12 tahun : 0.5 - 1 kaplet, 3-4 kali per hari. Penggunaan maximum 4 kaplet per hari.
                        </p>
                    </div>
                    <div class="py-2">
                        <div class="flex items-start">
                            <p class="rounded-lg p-1.5 px-4 text-white text-lg font-semibold bg-mainColor">Indikasi Umum
                            </p>
                        </div>
                        <p class="py-3"> Obat ini digunakan untuk meredakan nyeri ringan hingga sedang seperti sakit
                            kepala, sakit gigi, nyeri otot, serta menurunkan demam.</p>
                    </div>
                    <div class="py-2">
                        <div class="flex items-start">
                            <p class="rounded-lg p-1.5 px-4 text-white text-lg font-semibold bg-mainColor">Perhatian</p>
                        </div>
                        <p class="py-3"> Hati-hati penggunaan pada pasien dengan gagal ginjal, gangguan fungsi hati,
                            dan alergi atau mengalami hipersensitivitas terhadap paracetamol.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.components.footer')
</body>

</html>