<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Detail Pesanan</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
</head>
<body class="font-Inter bg-semiWhite">
    @include('user.components.navbar')

    <div class="flex justify-center">
        <div class="w-[80vw] py-10 flex justify-between">
            <div class="w-[60%] rounded-t-xl overflow-hidden gap-6 flex-col flex bg-white">
                <div class="bg-secondaryColor px-8 py-4 flex justify-between font-semibold items-center">
                    <p>Detail Pesanan</p>
                    <p>{{ $carts->count() }} Item</p>
                </div>

                <div class="text-sm px-8">
                    <p>Tanggal Pesanan : <span class="font-semibold">{{ date('d F Y',strtotime(NOW())) }}</span> </p>
                    <p>Batas Pengambilan : <span class="font-semibold">{{ date('d F Y',strtotime(NOW() . "3days")) }}</span> </p>
                </div>
                @php
                    $jumlah = 0;
                    $resep = false;
                @endphp

                @foreach($carts as $cart)
                <div class="px-8 flex justify-between">
                    <div class="flex gap-2">
                        @if (file_exists(public_path('storage/gambar-obat/' . $cart->product_photo)) && $cart->product_photo !== NULL)
                            <img src="{{ asset('storage/gambar-obat/' . $cart->product_photo) }}" width="100px" alt="" draggable="false">
                        @else
                            <img src="{{ asset('img/obat1.jpg')}}" width="100px" alt="" draggable="false">    
                        @endif

                        <div class="flex flex-col justify-between text-sm">
                            <div class="w-[25vw]">
                                <p class="font-bold">{{ $cart->product_name }}</p>
                                <p>Kategori : {{ $cart->category }}</p>
                            </div>

                            @if ($cart->product_type == "resep dokter")
                                @php
                                    $resep = true;
                                @endphp
                                <p class="bg-red-600 text-white w-fit px-2 font-semibold text-xs py-1 rounded-md">Perlu Resep</p>
                            @endif
                            
                            <p>EXP :  <span class="font-semibold">{{ date('d F Y',strtotime($cart->product_expired)) }}</span></p>
                        </div>
                    </div>

                    <div class="text-end w-[10vw]">
                        <p>{{ $cart->quantity }} x Rp.{{ number_format($cart->product_sell_price, 0, ',', '.') }}</p>
                        <p>Total : Rp.{{ number_format($cart->total_harga, 0, ',', '.') }}</p>
                    </div>
                </div>
                @php
                    $jumlah += $cart->total_harga;
                @endphp
                @endforeach

                <hr class="border-1 border border-black opacity-25">

                <div class="flex justify-between px-8">
                    <p>Total Pesanan</p>
                    <p class="font-bold">Rp.{{ number_format($jumlah, 0, ',', '.') }}</p>
                </div>

                <div class="px-8 text-red-600 text-sm">
                    <p>* Harap untuk membaca S&K sebelum melakukan pemesanan</p>
                    <p>* Apotek kami tidak menerima pengajuan refund untuk pesanan yang telah melawati masa batas pengambilan</p>
                </div>

            </div>

            <form action="/booking" method="post" enctype="multipart/form-data"
            class="bg-mainColor px-12 pt-10  pb-14 w-[36%] rounded-xl shadow-md flex flex-col gap-4 h-fit">
                @csrf
                <p class="font-bold text-white text-2xl">Form Pesanan</p>
                @error('buktiPembayaran')
                    <div class="text-sm text-red-200 mt-1 ms-3 mb-0 text-left">
                        {{ $message }}
                    </div>
                @enderror
                <input type="text" name="nama" placeholder="Nama Pengambil Pesanan" value="{{ auth()->user()->username }}" required class="h-12 px-4 rounded-2xl shadow-md">
                @error('nama')
                    <div class="text-sm text-red-200 ms-3 mb-0 text-left">
                        {{ $message }}
                    </div>
                @enderror
                
                <input type="number" name="nomor_telepon" placeholder="No. HP" value="{{ auth()->user()->customer->customer_phone }}" required class="h-12 px-4 rounded-2xl shadow-md">
                @error('nomor_telepon')
                    <div class="text-sm text-red-200 ms-3 mb-0 text-left">
                        {{ $message }}
                    </div>
                @enderror
                
                @if ($resep)
                    <div class="flex flex-col gap-2">
                        <label for="resepDokter" class="h-12 px-4 rounded-2xl shadow-md shadow-mediumGrey h-10 px-3 text-sm bg-white cursor-pointer flex gap-2 justify-start items-center">
                            <input type="file" name="resep_dokter" id="resepDokter" onchange="updateLabel()" class="hidden" accept=".pdf, .png, .jpg, .jpeg" required>
                            
                            <div class="w-7 h-7 rounded-full bg-mainColor text-white flex items-center justify-center">
                                <i class="fa-solid fa-download"></i>
                            </div>
                            
                            <p id="fileName" class="opacity-50">Upload Resep Dokter</p>
                        </label>
                        <p class="text-red-200 text-bold text-base px-4">*wajib menyertakan resep dokter</p>
                    </div>
                    @error('resep_dokter')
                        <div class="text-sm text-red-200 mt-1 ms-3 mb-0 text-left">
                            {{ $message }}
                        </div>
                    @enderror
                @endif

                <input type="text" name="catatan" autocomplete="off" placeholder="Catatan Opsional" class="h-12 px-4 rounded-2xl shadow-md">

                <input type="hidden" name="total" value="{{ $jumlah }}">

                <button type="submit" class="bg-secondaryColor px-4 h-12 text-xl font-bold text-white rounded-2xl">Bayar Sekarang</button>
            </form>
        </div>
    </div>

    @include('user.components.footer')

    <script>
        const updateLabel = () => {
        const input = document.getElementById('resepDokter');
        const fileName = input.files[0].name;
        const label = document.getElementById('fileName');
        label.textContent = fileName;
        }
    </script>
</body>
</html>