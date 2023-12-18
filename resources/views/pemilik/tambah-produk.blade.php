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
            <a href="/owner/produk" class="p-3 px-4 rounded-full bg-mainColor w-fit">
                <i class="fa-solid fa-arrow-left" style="color: white;"></i>
            </a>

            <p class="text-3xl font-TripBold my-3 mt-8">Tambah Produk</p>

            {{-- container --}}
            <div class="rounded-lg shadow-lg w-full bg-white h-fit md:p-16 md:px-24 p-7 overflow-x-auto">
                <form action="{{ route('add-product-process') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    @php
                        $uuid = \Illuminate\Support\Str::uuid();
                        $desc_uuid = \Illuminate\Support\Str::uuid();
                        $detail_uuid = \Illuminate\Support\Str::uuid();

                    @endphp
                    <div class="flex flex-col justify-center items-center mb-3">
                        <p class="text-3xl font-TripBold">Tambah Produk</p>
                        <input type="hidden" name="id" value="{{ $uuid }}">
                        <input type="hidden" name="desc_id" value="{{ $desc_uuid }}">
                        <input type="hidden" name="detail_id" value="{{ $detail_uuid }}">
                        {{-- status --}}
                        <input type="hidden" name="status" value="aktif">
                    </div>

                    <div class="md:flex md:grid-col-4 gap-8 justify-between">
                        <div class="flex-col w-full">
                            <p class="mt-5">Nama Obat</p>
                            <input type="text" id="" placeholder="Nama Obat" name="nama_obat" required 
                                class="p-2 w-full border rounded-xl shadow @error('nama_obat') is-invalid @enderror" value="{{ old('nama_obat') }}">
                                @error('nama_obat')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                                @enderror

                            <p class="mt-5">Kategori Obat</p>
                            {{-- kategori --}}
                            <div class="w-full rounded-xl border shadow p-2">
                                <select name="kategori" id="" @selected(true) class="outline-none w-full" required>
                                    <option disabled selected>Kategori Obat</option>
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->category_id }}">
                                            {{ $item->category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <p class="mt-5">Harga Beli Obat</p>
                            <input type="text" id="" placeholder="Harga Beli Obat" name="harga_beli" required
                                class="p-2 w-full border rounded-xl shadow @error('harga_beli') is-invalid @enderror" value="{{ old('harga_beli') }}">
                                @error('harga_beli')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="flex-col w-full">
                            <p class="mt-5">Expired Obat</p>
                            <input type="date" id="" placeholder="Expired Obat" name="expired_date" required
                                class="p-2 w-full border rounded-xl shadow @error('expired_date') is-invalid @enderror" value="{{ old('expired_date') }}">
                                @error('expired_date')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                                @enderror

                            <p class="mt-5">Golongan Obat</p>
                            {{-- golongan --}}
                            <div class="w-full rounded-xl border shadow p-2">
                                <select name="golongan" id="" @selected(true) class="outline-none w-full" required>
                                    <option disabled selected>Golongan Obat</option>
                                    @foreach ($groups as $item)
                                        <option value="{{ $item->group_id }}">
                                            {{ $item->group }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <p class="mt-5">Harga Jual Obat</p>
                            <input type="text" id="" placeholder="Harga Jual Obat" name="harga_jual" required
                                class="p-2 w-full border rounded-xl shadow @error('harga_jual') is-invalid @enderror" value="{{ old('harga_jual') }}">
                                @error('harga_jual')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                                @enderror
                        </div>

                        <div class="flex-col w-full">
                            <p class="mt-5">Stok Obat</p>
                            <input type="text" id="" placeholder="Stok Obat" name="stock" required
                                class="p-2 w-full border rounded-xl shadow @error('stock') is-invalid @enderror" value="{{ old('stock') }}">
                                @error('stock')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                                @enderror

                            <p class="mt-5">Satuan Obat</p>
                            {{-- satuan --}}
                            <div class="w-full rounded-xl border shadow p-2">
                                <select name="satuan_obat" id="" @selected(true) class="outline-none w-full" required>
                                    <option disabled {{ old('satuan_obat') == null ? 'selected' : '' }}>Satuan Obat</option>
                                    @foreach ($units as $item)
                                        <option value="{{ $item->unit_id }}" {{ old('satuan_obat') == $item->unit_id ? 'selected' : '' }}>
                                            {{ $item->unit }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <p class="mt-5">NIE Obat</p>
                            <input type="text" name="NIE" required placeholder="NIE Obat" class="p-2 w-full border rounded-xl shadow @error('NIE') is-invalid @enderror" value="{{ old('NIE') }}">
                            @error('NIE')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="flex-col w-full">
                            <p class="mt-5">Tipe Obat</p>
                            {{-- tipe --}}
                            <div class="w-full rounded-xl border shadow p-2">
                                <select name="tipe" id="" @selected(true) class="outline-none w-full" required>
                                    <option disabled {{ old('tipe') == null ? 'selected' : '' }}>Tipe Obat</option>
                                    @foreach ($types as $item)
                                        <option value="{{ $item }}" {{ old('tipe') == $item ? 'selected' : '' }}>{{ $item }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <p class="mt-5">Pemasok Obat</p>
                            {{-- pemasok --}}
                            <div class="w-full rounded-xl border shadow p-2">
                                <select name="pemasok" id="" class="outline-none w-full" required>
                                    <option disabled {{ old('pemasok') == null ? 'selected' : '' }}>Pemasok Obat</option>
                                    @foreach ($suppliers as $item)
                                        <option value="{{ $item->supplier_id }}" {{ old('pemasok') == $item->supplier_id ? 'selected' : '' }}>
                                            {{ $item->supplier }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            

                            <p class="mt-5">Produksi dari</p>
                            <input type="text" name="produksi" id="" placeholder="Produksi dari"  required value="{{ old('produksi') }}"
                                class="p-2 w-full border rounded-xl shadow @error('produksi') is-invalid @enderror">
                                @error('produksi')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>

                    <div class="md:flex md:grid-col-2 gap-8 justify-between">
                        <div class="flex-col w-full">
                            <p class="mt-5">Deskripsi Obat</p>
                            <textarea placeholder="Deskripsi Obat" name="deskripsi" required 
                                class="p-2 w-full border rounded-xl shadow h-28 @error('deskripsi') is-invalid @enderror">{{ old('deskripsi') }}</textarea>
                            @error('deskripsi')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex-col w-full">
                            <p class="mt-5">Efek Samping Obat</p>
                            <textarea name="efek_samping" placeholder="Efek Samping Obat" required
                                class="p-2 w-full border rounded-xl shadow h-8 @error('efek_samping') is-invalid @enderror">{{ old('efek_samping') }}</textarea>
                            @error('efek_samping')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>

                    <div class="md:flex md:grid-col-2 gap-8 justify-between">
                        <div class="flex-col w-full">
                            <p class="mt-5">Dosis Obat</p>
                            <textarea placeholder="Dosis Obat" name="dosis" required
                                class="p-2 w-full border rounded-xl shadow h-28 @error('dosis') is-invalid @enderror">{{ old('dosis') }}</textarea>
                            @error('dosis')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="flex-col w-full">
                            <p class="mt-5">Indikasi Umum Obat</p>
                            <textarea placeholder="Indikasi Umum Obat" name="indikasi"
                                class="p-2 w-full border rounded-xl shadow">{{ old('indikasi') }}</textarea>
                            @error('indikasi')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="md:flex md:grid-col-2 gap-8 justify-between">
                        <div class="flex-col w-full">
                            <p class="mt-5">Peringatan Obat</p>
                            <textarea placeholder="Peringatan Obat" name="peringatan"
                                class="p-2 w-full border rounded-xl shadow @error('peringatan') is-invalid @enderror">{{ old('peringatan') }}</textarea>
                            @error('peringatan')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="md:flex w-full">
                            <div class="w-[200px] h-[170px] p-1 mt-8">
                            <img src="" alt="" id="uploadedFile" class="max-w-full max-h-full">
                        </div>

                        <div class="ms-3 mt-3.5">
                            <input type="file" name="gambar_obat" id="file2" class="invisible @error('gambar_obat') is-invalid @enderror" accept="image/*" onchange="showFile(this)" required>
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

    {{-- <!-- Place the first <script> tag in your HTML's <head> -->
    <script src="https://cdn.tiny.cloud/1/fkny8lakkibesvbv59ae3w2w8d3d9vn18j36acymyng6i795/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- Place the following <script> and <textarea> tags your HTML's <body> -->
    <script>
    tinymce.init({
        selector: 'textarea',
    });
    </script> --}}

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