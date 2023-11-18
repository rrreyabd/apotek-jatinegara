<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilik Apotek | Produk</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

</head>

<body class="font-Trip bg-[#DEDEDE]">
    <div class="flex flex-col mb-8">
        <div class="p-10 flex flex-col">

            {{-- back button --}}
            <a href="{{ url()->previous()}}" class="p-3 px-4 rounded-full bg-mainColor w-fit">
                <i class="fa-solid fa-arrow-left" style="color: white;"></i>
            </a>

            <p class="text-3xl font-TripBold my-3 mt-8">Detail Produk</p>

            {{-- container --}}
            <div class="rounded-lg shadow-lg w-full bg-white h-fit md:p-16 md:px-24 p-3 overflow-x-auto">
                <p class="text-3xl font-TripBold my-5 flex justify-center">P-001</p>

                <div class="sm:flex sm:grid-cols-3 md:gap-20 gap-3">
                    {{-- gambar obat --}}
                    <div class="sm:w-1/6 mb-7 border-2 border-black rounded-lg h-fit">
                        <img src="{{ asset('img/Pencernaan.png/') }}" alt="" class="w-full p-5">
                        <p class="font-TripBold flex justify-center py-3 rounded-b-lg border-t-2">Paracetamol 500 mg</p>
                    </div>

                    {{-- detail obat --}}
                    <div class="1/3">
                        <p class="font-TripBold text-lg">Detail Obat:</p>

                            <table>
                                <tr>
                                    <td class="py-1">Status Obat</td>
                                    <td>: Aktif</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Ecpired Obat</td>
                                    <td>: 24 September 2023</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Stok Obat</td>
                                    <td>: 30</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Tipe Obat</td>
                                    <td>: Resep</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Harga Beli Obat</td>
                                    <td>: 3500</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Harga Jual Obat</td>
                                    <td>: 5000</td>
                                </tr>
                            </table>
                    </div>
                    <div class="w-1/3">
                            <table class="mt-7">
                                <tr>
                                    <td class="py-1">Kategori Obat</td>
                                    <td>: Obat Demam</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Golongan Obat</td>
                                    <td>: Bebas</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Satuan Obat</td>
                                    <td>: Strip</td>
                                </tr>
                                <tr>
                                    <td class="py-1">NIE Obat</td>
                                    <td>: GBL7802318304A2</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Pemasok Obat</td>
                                    <td>: PT. ABC</td>
                                </tr>
                                <tr>
                                    <td class="py-1">Produksi dari</td>
                                    <td>: PT. ABC</td>
                                </tr>
                            </table>
                    </div>
                </div>

                {{-- deskripsi obat --}}
                <div class="w-full my-2">
                    <p class="font-TripBold text-lg">Deskripsi Obat:</p>
                    <p class="text-lg">Paracetamol tablet merupakan obat yang dapat digunakan untuk meringankan rasa
                        sakit pada sakit kepala, sakit gigi, dan menurunkan demam.</p>
                </div>

                <div class="w-full my-2">
                    <p class="font-TripBold text-lg">Dosis Obat:</p>
                    <p class="text-lg">Dewasa: 1-2 kaplet, 3-4 kali per hari. Penggunaan maximum 8 kaplet per hari. </p>
                    <p>Anak 7-12 tahun : 0.5 - 1 kaplet, 3-4 kali per hari. Penggunaan maximum 4 kaplet per hari.</p>
                </div>

                <div class="w-full my-2">
                    <p class="font-TripBold text-lg">Peringatan Obat:</p>
                    <p class="text-lg">Hati-hati penggunaan pada pasien dengan gagal ginjal, gangguan fungsi hati, dan
                        alergi atau mengalami hipersensitivitas terhadap paracetamol.</p>
                </div>

                <div class="w-full my-2">
                    <p class="font-TripBold text-lg">Efek Samping Obat:</p>
                    <p class="text-lg">Penggunaan untuk jangka waktu lama dan dosis besar dapat menyebabkan kerusakan
                        fungsi hati. </p>
                    <p>Reaksi hipersensitifitas/ alergi.</p>
                </div>

                <div class="w-full my-2">
                    <p class="font-TripBold text-lg">Indikasi Umum Obat:</p>
                    <p class="text-lg">Obat ini digunakan untuk meredakan nyeri ringan hingga sedang seperti sakit
                        kepala, sakit gigi, nyeri otot, serta menurunkan demam.</p>
                </div>
            </div>
        </div>
    </div>
</body>
</html>