<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilik Apotek | Edit Produk</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
</head>

<body class="font-Trip bg-[#DEDEDE]">
    
    <div class="flex flex-col mb-8">
        <div class="p-10 flex flex-col">
            {{-- back button --}}
            <a href="/owner/produk" class="p-3 px-4 rounded-full bg-mainColor w-fit">
                <i class="fa-solid fa-arrow-left" style="color: white;"></i>
            </a>
            @php
                $uuid = $product->product_id;
            @endphp
            <p class="text-3xl font-TripBold my-3 mt-8">Edit Produk</p>

            {{-- container --}}
            <div class="rounded-lg shadow-lg w-full bg-white h-fit md:p-16 md:px-24 p-7 overflow-x-auto">
                <form action="{{ route('product-proccess-update',['id'=> $product->product_id]) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="flex flex-col justify-center items-center mb-3">
                        <p class="text-3xl font-TripBold">Edit Produk</p>
                        {{-- status --}}
                        <div class="w-fit rounded-lg border-2 shadow p-1.5 px-3 mt-3">
                            <select name="status" id="" @selected(true) class="outline-none">
                            @if ($product->product_status != 'exp')
                                @foreach ($status as $item)
                                    <option value="{{ $item }}" {{ $product->product_status == $item ? 'selected' : '' }}>
                                        {{ $item }}
                                    </option>
                                @endforeach
                            @else
                                <option value="{{ $product->product_status }}">
                                    Expired
                                </option>
                                @endif
                            </select>
                        </div>
                        
                        @error('harga_jual')
                        <div class="text-xs text-mediumRed">{{ $message }}</div>
                        @enderror
                        @if ($product->product_status == 'exp')
                            <p class="text-s text-red-500">Tambahkan Batch Baru Dengan Exp > 3bulan untuk membuka status dari <a href="/owner/detail-produk/{{ $product->product_id }}" class="underline text-blue-700">detail produk</a></p>
                        @endif

                        <p class="mt-5">Harga Jual Obat</p>
                        <input type="number" id="" placeholder="Harga Jual Obat" name="harga_jual"
                            class="p-2 w-auto text-center border rounded-xl shadow @error('harga_jual') is-invalid @enderror" value="{{ $product->product_sell_price }}">
                    </div>

                    <div class="md:flex md:grid-col-4 gap-8 justify-between">
                        <div class="flex-col w-full">
                            {{-- Nama Obat --}}
                            <p class="mt-5">Nama Obat</p>
                            <input type="text" id="" placeholder="Nama Obat"  name="nama_obat"
                                class="p-2 w-full border rounded-xl shadow @error('nama_obat') is-invalid @enderror" value="{{ $product->product_name }}">
                                @error('nama_obat')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                                @enderror

                            {{-- Kategori Obat --}}
                            <p class="mt-5">Kategori Obat</p>
                            <div class="w-full rounded-xl border shadow p-2">
                                <select name="kategori" id="" @selected(true) class="outline-none w-full">
                                    @foreach ($categories as $item)
                                        <option value="{{ $item->category_id }}" {{ $product->description->category->category == $item->category ? 'selected' : '' }}>
                                            {{ $item->category }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            </div>
                                @php
                                    $carbonDate = \Carbon\Carbon::parse( $product->detail()->orderBy('product_expired')->first()->product_expired);
                                    $formattedDate = $carbonDate->format('Y-m-d');
                                @endphp

                            <div class="flex-col w-full">
                            {{-- golongan --}}
                            <p class="mt-5">Golongan Obat</p>
                            <div class="w-full rounded-xl border shadow p-2">
                                <select name="golongan" id="" @selected(true) class="outline-none w-full">
                                    @foreach ($groups as $item)
                                        <option value="{{ $item->group_id }}" {{ $product->description->group->group == $item->group ? 'selected' : '' }}>
                                            {{ $item->group }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                                {{-- satuan --}}
                                <p class="mt-5">Jenis Obat</p>
                                <div class="w-full rounded-xl border shadow p-2">
                                    <select name="satuan_obat" id="" @selected(true) class="outline-none w-full">
                                        @foreach ($units as $item)
                                            <option value="{{ $item->unit_id }}" {{ $product->description->unit->unit == $item->unit ? 'selected' : '' }}>
                                                {{ $item->unit }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                        </div>

                        <div class="flex-col w-full">
                            <p class="mt-5">NIE Obat</p>
                            <input type="text" id="" name="NIE" placeholder="NIE Obat" class="p-2 w-full border rounded-xl shadow @error('NIE') is-invalid @enderror" value="{{ $product->description->product_DPN }}">
                            @error('NIE')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                            @enderror

                            <p class="mt-5">Tipe Obat</p>
                            {{-- tipe --}}
                            <div class="w-full rounded-xl border shadow p-2">
                                <select name="tipe" id="" @selected(true) class="outline-none w-full">
                                    @foreach ($types as $item)
                                        <option value="{{ $item }}" {{ $product->description->product_type == $item ? 'selected' : '' }}>
                                            {{ $item }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="flex-col w-full">

                            <p class="mt-5">Pemasok Obat</p>
                            {{-- pemasok --}}
                            <div class="w-full rounded-xl border shadow p-2">
                                <select name="pemasok" id="" @selected(true) class="outline-none w-full">
                                    @foreach ($suppliers as $item)
                                        <option value="{{ $item->supplier_id }}" {{ $product->description->supplier->supplier == $item->supplier ? 'selected' : '' }}>
                                            {{ $item->supplier }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <p class="mt-5">Produksi dari</p>
                            <input type="text" id="" placeholder="Produksi dari" name="produksi"
                                class="p-2 w-full border rounded-xl shadow @error('produksi') is-invalid @enderror" value="{{ $product->description->product_manufacture }}">
                                @error('produksi')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                                @enderror
                        </div>
                    </div>

                    <div class="md:flex md:grid-col-2 gap-8 mt-14 justify-between">
                        <div class="flex-col w-full">
                            <p class="mt-5">Deskripsi Obat</p>
                            <textarea type="text" id="" placeholder="Deskripsi Obat" name="deskripsi"
                            class="p-2 w-full border rounded-xl shadow h-28">{{ $product->description->product_description }}</textarea>
                        </div>
                        <div class="flex-col w-full">
                            <p class="mt-5">Efek Samping Obat</p>
                            <textarea id="" placeholder="Efek Samping Obat" name="efek_samping"
                                class="p-2 w-full border rounded-xl shadow h-28">{{ $product->description->product_sideEffect }}</textarea>
                        </div>
                    </div>

                    <div class="md:flex md:grid-col-2 gap-8 justify-between">
                        <div class="flex-col w-full">
                            <p class="mt-5">Dosis Obat</p>
                            <textarea id="" placeholder="Dosis Obat" name="dosis"
                                class="p-2 w-full border rounded-xl shadow h-28 @error('dosis') is-invalid @enderror">{{ $product->description->product_dosage }}</textarea>
                                @error('dosis')
                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                                @enderror
                        </div>
                        @if ($product->description->product_indication != NULL)
                            <div class="flex-col w-full">
                                <p class="mt-5">Indikasi Umum Obat</p>
                                <textarea id="" placeholder="Indikasi Umum Obat" name="indikasi"
                                    class="p-2 w-full border rounded-xl shadow h-28">{{ $product->description->product_indication }}</textarea>
                            </div>
                        @endif
                    </div>

                    <div class="md:flex md:grid-col-2 gap-8 justify-between">
                        @if ($product->description->product_notice != NULL)
                            <div class="flex-col w-full">
                                <p class="mt-5">Peringatan Obat</p>
                                <textarea id="" placeholder="Peringatan Obat" name="peringatan"
                                    class="p-2 w-full border rounded-xl shadow h-28">{{ $product->description->product_notice }}"></textarea>
                            </div>
                        @endif

                        <div class="md:flex w-6/12">
                            <div class="w-[200px] h-[170px] p-1 mt-8">
                                @if (file_exists(public_path('storage/gambar-obat/' . $product->description->product_photo)) && $product->description->product_photo !== NULL)
                                <img src="{{ asset('storage/gambar-obat/'.$product->description->product_photo) }}" id="uploadedFile" alt="Current Image" class="max-w-full max-h-full">
                            @else
                                <img src="{{ asset('img/obat1.jpg')}}" id="uploadedFile" alt="Current Image" class="max-w-full max-h-full">    
                            @endif
                        </div>

                        <div class="ms-3 mt-3.5">
                            <input type="file" id="file2" name="gambar_obat" class="invisible" accept="image/*" onchange="showFile(this)">
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
                    <button type="submit" class="w-48 bg-mainColor px-4 py-2 font-semibold text-lg text-white rounded-lg shadow shadow-semiBlack">Edit</button>
                    </div>
                </form>
            </div>

            @php
                $i=1;
            @endphp
            @foreach ($product->detail()->orderBy('product_expired')->get() as $detail)
                <div class="rounded-lg mt-16 shadow-lg w-full bg-white h-fit md:p-16 md:px-24 p-7 overflow-x-auto">
                    <div class="flex flex-col justify-center items-center mb-3">
                            <p class="text-3xl font-TripBold">{{ $product->product_name }} (Batch {{ $i }})</p>

                            <p class="mt-5 text-red-500">Tidak Dapat Melakukan Editing Pada Batch</p>
                        </div>

                        <div class="md:flex md:grid-col-4 gap-8 justify-between">
                            <div class="flex-col w-full">
                                {{-- Harga Beli Obat --}}
                                <p class="mt-5">Harga Beli Obat</p>
                                <input type="number" id="" placeholder="Harga Beli Obat" name="harga_beli" 
                                    class="p-2 w-full border rounded-xl shadow @error('nama_obat') is-invalid @enderror text-slate-400" value="{{ number_format($detail->product_buy_price, 0, ',', '.') }}" readonly>
                                </div>
                                @php
                                        $carbonDate = \Carbon\Carbon::parse( $detail->product_expired);
                                        $formattedDate = $carbonDate->format('Y-m-d');
                                    @endphp

                                <div class="flex-col w-full">
                                <p class="mt-5">Expired Obat</p>
                                <input type="date" id="" placeholder="Expired Obat" name="expired_date"
                                    class="p-2 w-full border rounded-xl shadow @error('expired_date') is-invalid @enderror text-slate-400" value="{{ $formattedDate }}" readonly>
                            </div>

                            <div class="flex-col w-full">
                                <p class="mt-5">Stok Obat</p>
                                <input type="number" id="" placeholder="Stok Obat" name="stock"
                                    class="p-2 w-full border rounded-xl shadow @error('stock') is-invalid @enderror text-slate-400" value="{{ $detail->product_stock }}" readonly>
                            </div>
                        </div>

                        <div class="flex justify-center mt-8">
                            <button disabled class="w-48 bg-slate-300 px-4 py-2 font-semibold text-lg text-white rounded-lg shadow shadow-semiBlack">Edit</button>
                        </div>
                    </div>
                    @php
                        $i++;
                    @endphp
                @endforeach
            </div>
    </div>

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