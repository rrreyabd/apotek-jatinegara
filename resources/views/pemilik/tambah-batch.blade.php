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

            <p class="text-3xl font-TripBold my-3 mt-8">Tambah Batch</p>

            {{-- container --}}
            <div class="rounded-lg shadow-lg w-full bg-white h-fit md:p-16 md:px-24 p-7 overflow-x-auto">
                <form action="{{ route('add-batch-process') }}" method="POST">
                    @csrf
                    
                    @method('PUT')

                    @php
                        $uuid = $product->product_id;
                        $detail_uuid = \Illuminate\Support\Str::uuid();
                    @endphp

                    <div class="flex flex-col justify-center items-center mb-3">
                        <p class="text-3xl font-TripBold">{{ $product->product_name }}</p>
                        <input type="hidden" name="id" value="{{ $uuid }}">
                        <input type="hidden" name="detail_id" value="{{ $detail_uuid }}">
                    </div>

                    <div class="md:flex md:grid-col-4 gap-8 justify-between">
                        <div class="flex-col w-full">
                            <p class="mt-5">Nama Obat</p>
                            <input type="text" id="" placeholder="Nama Obat" name="nama_obat" required 
                                class="p-2 w-full text-slate-400 border rounded-xl shadow @error('nama_obat') is-invalid @enderror" value="{{ $product->product_name }}" readonly>

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

                            

                            <p class="mt-5">Harga Jual Obat</p>
                            <input type="text" id="" placeholder="Harga Jual Obat" name="harga_jual" required
                                class="p-2 w-full text-slate-400 border rounded-xl shadow @error('harga_jual') is-invalid @enderror" value="{{ number_format($product->product_sell_price, 0, ',', '.') }}" readonly>
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