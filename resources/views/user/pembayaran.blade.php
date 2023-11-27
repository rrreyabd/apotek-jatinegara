<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Pembayaran</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
</head>
<body class="font-Inter h-[100vh] w-full bg-tertiaryColor flex justify-center items-center relative">
    <div class="w-[80%] bg-white rounded-xl overflow-hidden shadow-lg shadow-semiBlack">
        <div class="h-[8vh] px-8 py-4 w-full bg-mainColor flex items-center justify-between text-lg font-semibold text-white">
            <p class="textShadow">Total Pembayaran</p>
            <p class="textShadow">Rp. {{ number_format($totalHarga, 0, ',', '.') }}</p>
        </div>
        
            <form action="/pembayaran" method="post" enctype="multipart/form-data">
                @csrf
                <div class="h-full w-full bg-secondaryColor flex flex-col gap-10 items-center py-8">
                    <div class="flex flex-col gap-6 items-center w-full">
                    <p class="text-xl font-bold text-white textShadow">Pilihan Rekening & E-Wallet</p>

                    <div class="flex gap-4 justify-between w-[50vw] flex-wrap">
                        {{-- gopay --}}
                        <div class="relative">
                            <input type="text" class="w-[24vw] shadow-sm shadow-mediumGrey h-10 pl-24 rounded-full text-sm" placeholder="987123 a.n Gopal" readonly>
                            
                            <label for="paymentMethod1" class="flex gap-2 items-center absolute left-3 top-[26%] cursor-pointer">
                                <input type="radio" name="paymentMethod" value="Gopay" id="paymentMethod1" class="h-5 w-5" required>
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Gopay_logo.svg/1280px-Gopay_logo.svg.png" alt="" class="h-3 w-12">
                            </label>
                        </div>
                        {{-- akhir gopay --}}
                        {{-- shopeepay --}}
                        <div class="relative">
                            <input type="text" readonly class="w-[24vw] shadow-sm shadow-mediumGrey h-10 pl-24 rounded-full text-sm" placeholder="987123 a.n Gopal">
                            
                            <label for="paymentMethod2" class="flex gap-2 items-center absolute left-3 top-[26%] cursor-pointer">
                                <input type="radio" name="paymentMethod" value="Shopeepay" id="paymentMethod2" class="h-5 w-5">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/f/fe/Shopee.svg/375px-Shopee.svg.png" alt="" class="h-3 w-12">
                            </label>
                        </div>
                        {{-- akhir shopeepay --}}
                        {{-- BCA --}}
                        <div class="relative">
                            <input type="text" readonly class="w-[24vw] shadow-sm shadow-mediumGrey h-10 pl-24 rounded-full text-sm" placeholder="987123 a.n Gopal">
                            
                            <label for="paymentMethod3" class="flex gap-2 items-center absolute left-3 top-[26%] cursor-pointer">
                                <input type="radio" name="paymentMethod" value="BCA" id="paymentMethod3" class="h-5 w-5">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/5/5c/Bank_Central_Asia.svg/330px-Bank_Central_Asia.svg.png" alt="" class="h-3 w-12">
                            </label>
                        </div>
                        {{-- akhir BCA --}}
                        {{-- Mandiri --}}
                        <div class="relative">
                            <input type="text" readonly class="w-[24vw] shadow-sm shadow-mediumGrey h-10 pl-24 rounded-full text-sm" placeholder="987123 a.n Gopal">
                            
                            <label for="paymentMethod4" class="flex gap-2 items-center absolute left-3 top-[26%] cursor-pointer">
                                <input type="radio" name="paymentMethod" value="Mandiri" id="paymentMethod4" class="h-5 w-5">
                                <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/a/ad/Bank_Mandiri_logo_2016.svg/330px-Bank_Mandiri_logo_2016.svg.png" alt="" class="h-3 w-12">
                            </label>
                        </div>
                        {{-- akhir Mandiri --}}
                    </div>
                </div>

                <div class="flex flex-col gap-4 items-center w-full">
                    <p class="text-xl font-bold text-white textShadow">Bukti Pembayaran</p>

                    <label for="buktiPembayaran" class="w-[24vw] shadow-sm shadow-mediumGrey h-10 px-3 rounded-full text-sm bg-white cursor-pointer flex gap-2 justify-start items-center">
                        <input type="file" onchange="updateLabel()" name="buktiPembayaran" required id="buktiPembayaran" class="hidden" accept=".pdf, .png, .jpg, .jpeg">
                        
                        <div class="w-7 h-7 rounded-full bg-mainColor text-white flex items-center justify-center">
                            <i class="fa-solid fa-download"></i>
                        </div>
                        
                        <p id="fileName" class="text-mediumGrey">Upload Bukti Pembayaran</p>
                    </label>
                    <p class="text-red-500 text-bold text-base px-4">*wajib menyertakan bukti pembayaran</p>
                    @error('buktiPembayaran')
                        <div class="text-sm text-red-200 mt-1 ms-3 mb-0 text-left">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="flex flex-col gap-4 w-[70vw]">
                    <div class="h-fit px-8 py-2 bg-red-600 text-white font-semibold rounded-md">
                        <p>Harap untuk membaca S&K sebelum melakukan pesanan</p>
                        <p>Apotek kami tidak menerima pengajuan refund untuk pesanan yang telah melewati masa batas pengambilan</p>
                    </div>
                    
                    <div class="flex justify-start items-start gap-2 text-white text-base">
                        <input type="radio" name="s&k" id="" required class="w-6 h-6">
                        <p>Saya telah membaca dan memahami Syarat & Ketentuan Situs Apotek Jati Negara (yang dapat mengalami perubahan dari waktu ke waktu), dan dengan ini saya menyetujui untuk terikat pada ketentuan tersebut.</p>
                    </div>
                </div>

                <input type="hidden" name="nama" value="{{ $nama }}">
                <input type="hidden" name="nomor_telepon" value="{{ $nomor_telepon }}">
                <input type="hidden" name="resep_dokter" value="{{ $resep_dokter }}">
                @if ($catatan != NULL)
                    <input type="hidden" name="catatan" value="{{ $catatan }}">
                @endif
                <input type="hidden" name="status" value="Menunggu Konfirmasi">

                <div class="w-[70vw] flex justify-end text-white font-semibold gap-4">
                    <button type="button" class="bg-red-600 h-fit w-fit px-10 py-1 rounded-lg shadow-md">
                        Kembali
                    </button>
                    <button type="submit" class="bg-mainColor h-fit w-fit px-10 py-1 rounded-lg shadow-md">
                        Kirim
                    </button>
                </div>
            </form>
            </div>
        </div>

<script>
    const updateLabel = () => {
    const input = document.getElementById('buktiPembayaran');
    const fileName = input.files[0].name;
    const label = document.getElementById('fileName');
    label.textContent = fileName;
    }
</script>
</body>
</html>