<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilik Apotek | Tambah Produk</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    {{-- DATATABLES --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

    <style>
        textarea {
            min-height: 300px; 
            resize: vertical; 
        }
    </style>
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
                                class="p-2 w-full border rounded-xl shadow" value="hati hati dijalan">
                        </div>
                        <div class="md:flex w-full">
                            <div class="w-[200px] h-[170px] p-1 mt-8">
                            <img src="" alt="" id="uploadedFile" class="max-w-full max-h-full">
                        </div>

                        <div class="ms-3 mt-3.5">
                            <input type="file" id="file2" class="invisible" accept="image/*" onchange="showFile(this)">
                            <button id="file" onclick="document.getElementById('file2').click(); return false;" class="p-2 w-full border rounded-xl shadow">
                                <div class="flex items-center gap-2">
                                    <i class="fa-solid fa-arrow-up-from-bracket p-2 px-2.5 rounded-full bg-mainColor w-fit ms-2" style="color: white;"></i>
                                    <p class="text-mediumGrey">Upload Gambar Produk</p>
                                </div   >
                            </button>
                            <p class="text-xs text-mediumRed mt-2">*Maks 2MB</p>
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

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

     <script>
        function showFile(input) {
        const getFile = document.getElementById('uploadedFile');
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = (e) => {
                getFile.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>
</html>