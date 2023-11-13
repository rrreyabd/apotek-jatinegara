<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilik Apotek | Tambah Kasir</title>
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

            <p class="text-3xl font-TripBold my-3 mt-8">Tambah Produk</p>

            {{-- container --}}
            <div class="rounded-lg shadow-lg w-full bg-white h-fit md:p-16 md:px-24 p-7 overflow-x-auto">
                <form action="">
                    <div class="flex flex-col justify-center items-center mb-3">
                        <p class="text-3xl font-TripBold">P-001</p>
                        {{-- status --}}
                        <div class="w-fit rounded-lg border-2 shadow p-1.5 px-3 mt-3">
                            <select name="" id="" @selected(true) class="outline-none">
                                <option disabled selected>Status Obat</option>
                                <option value="">Aktif</option>
                                <option value="">Tidak Aktif</option>
                            </select>
                        </div>
                    </div>

                    <div class="md:flex md:grid-col-4 gap-8 justify-between">
                        <div class="flex-col w-full">
                            <p class="mt-5">Nama Obat</p>
                            <input type="text" id="" placeholder="Nama Obat"
                                class="p-2 w-full border rounded-xl shadow">

                            <p class="mt-5">Kategori Obat</p>
                            {{-- kategori --}}
                            <div class="w-full rounded-xl border shadow p-2">
                                <select name="" id="" @selected(true) class="outline-none w-full">
                                    <option disabled selected>Kategori Obat</option>
                                    <option value="">Aktif</option>
                                    <option value="">Tidak Aktif</option>
                                </select>
                            </div>

                            <p class="mt-5">Harga Beli Obat</p>
                            <input type="text" id="" placeholder="Harga Beli Obat"
                                class="p-2 w-full border rounded-xl shadow">
                        </div>

                        <div class="flex-col w-full">
                            <p class="mt-5">Expired Obat</p>
                            <input type="text" id="" placeholder="Expired Obat"
                                class="p-2 w-full border rounded-xl shadow">

                            <p class="mt-5">Golongan Obat</p>
                            {{-- golongan --}}
                            <div class="w-full rounded-xl border shadow p-2">
                                <select name="" id="" @selected(true) class="outline-none w-full">
                                    <option disabled selected>Golongan Obat</option>
                                    <option value="">Obat Demam</option>
                                    <option value="">Obat Batuk</option>
                                </select>
                            </div>

                            <p class="mt-5">Harga Jual Obat</p>
                            <input type="text" id="" placeholder="Harga Jual Obat"
                                class="p-2 w-full border rounded-xl shadow">
                        </div>

                        <div class="flex-col w-full">
                            <p class="mt-5">Stok Obat</p>
                            <input type="text" id="" placeholder="Stok Obat"
                                class="p-2 w-full border rounded-xl shadow">

                            <p class="mt-5">Satuan Obat</p>
                            {{-- satuan --}}
                            <div class="w-full rounded-xl border shadow p-2">
                                <select name="" id="" @selected(true) class="outline-none w-full">
                                    <option disabled selected>Satuan Obat</option>
                                    <option value="">Sirup</option>
                                    <option value="">Strip</option>
                                    <option value="">Kotak</option>
                                </select>
                            </div>

                            <p class="mt-5">NIE Obat</p>
                            <input type="text" id="" placeholder="NIE Obat" class="p-2 w-full border rounded-xl shadow">
                        </div>

                        <div class="flex-col w-full">
                            <p class="mt-5">Tipe Obat</p>
                            {{-- tipe --}}
                            <div class="w-full rounded-xl border shadow p-2">
                                <select name="" id="" @selected(true) class="outline-none w-full">
                                    <option disabled selected>Tipe Obat</option>
                                    <option value="">Resep</option>
                                    <option value="">Umum</option>
                                </select>
                            </div>

                            <p class="mt-5">Pemasok Obat</p>
                            {{-- pemasok --}}
                            <div class="w-full rounded-xl border shadow p-2">
                                <select name="" id="" @selected(true) class="outline-none w-full">
                                    <option disabled selected>Pemasok Obat</option>
                                    <option value="">PT. ABC</option>
                                    <option value="">PT. DEF</option>
                                </select>
                            </div>

                            <p class="mt-5">Produksi dari</p>
                            <input type="text" id="" placeholder="Produksi dari"
                                class="p-2 w-full border rounded-xl shadow">
                        </div>
                    </div>

                    <div class="md:flex md:grid-col-2 gap-8 justify-between">
                        <div class="flex-col w-full">
                            <p class="mt-5">Deskripsi Obat</p>
                            <input type="text" id="" placeholder="Deskripsi Obat"
                                class="p-2 w-full border rounded-xl shadow">
                        </div>
                        <div class="flex-col w-full">
                            <p class="mt-5">Efek Samping Obat</p>
                            <input type="text" id="" placeholder="Efek Samping Obat"
                                class="p-2 w-full border rounded-xl shadow">
                        </div>
                    </div>

                    <div class="md:flex md:grid-col-2 gap-8 justify-between">
                        <div class="flex-col w-full">
                            <p class="mt-5">Dosis Obat</p>
                            <input type="text" id="" placeholder="Dosis Obat"
                                class="p-2 w-full border rounded-xl shadow">
                        </div>
                        <div class="flex-col w-full">
                            <p class="mt-5">Indikasi Umum Obat</p>
                            <input type="text" id="" placeholder="Indikasi Umum Obat"
                                class="p-2 w-full border rounded-xl shadow">
                        </div>
                    </div>

                    <div class="md:flex md:grid-col-2 gap-8 justify-between">
                        <div class="flex-col w-full">
                            <p class="mt-5">Peringatan Obat</p>
                            <input type="text" id="" placeholder="Peringatan Obat"
                                class="p-2 w-full border rounded-xl shadow">
                        </div>
                        <div class="md:flex w-full mt-5">
                            <img src="" alt="">

                            <div class="ms-3 mt-5">
                                <div class="p-2 px-3 rounded-full bg-mainColor w-fit">
                                    <i class="fa-solid fa-arrow-up-from-bracket" style="color: white;"></i>
                                </div>

                                <input type="file" id="" class="p-2 w-full border rounded-xl shadow appearance-none">
                                <p class="text-xs text-mediumRed">*Maks 2MB</p>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-center mt-8">
                    <button type="submit" class="w-48 bg-mainColor px-4 py-2 font-semibold text-lg text-white rounded-lg shadow shadow-semiBlack">Tambah</button>
                    </div>
                </form>

            </div>
        </div>
    </div>

</body>

</html>