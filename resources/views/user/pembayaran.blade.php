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
    <div class="w-[80%] h-[80vh] bg-white rounded-xl overflow-hidden shadow-lg shadow-semiBlack">
        <div class="h-[8vh] px-8 py-4 w-full bg-mainColor flex items-center justify-between text-lg font-semibold text-white">
            <p class="textShadow">Total Pembayaran</p>
            <p class="textShadow">Rp. 156.000</p>
        </div>

        <div class="h-[72vh] w-full bg-secondaryColor flex flex-col gap-10 items-center py-8">
            <div class="flex flex-col gap-6 items-center w-full">
                <p class="text-xl font-bold text-white textShadow">Pilihan Rekening & E-Wallet</p>

                <div class="flex gap-4 justify-between w-[50vw] flex-wrap">
                    @for ($i = 0; $i < 4; $i++)
                    <div class="relative">
                        <input type="text" class="w-[24vw] shadow-md shadow-mediumGrey h-10 pl-24 rounded-full text-sm" placeholder="987123 a.n Gopal">
                        
                        <label for="paymentMethod{{$i}}" class="flex gap-2 items-center absolute left-3 top-[26%] cursor-pointer">
                            <input type="radio" name="paymentMethod" id="paymentMethod{{$i}}" class="h-5 w-5">
                            <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/8/86/Gopay_logo.svg/1280px-Gopay_logo.svg.png" alt="" class="h-3 w-12">
                        </label>
                    </div>
                    @endfor
                </div>
            </div>

            <div class="flex flex-col gap-4 items-center w-full">
                <p class="text-xl font-bold text-white textShadow">Bukti Pembayaran</p>

                <label for="buktiPembayaran" class="w-[24vw] shadow-md shadow-mediumGrey h-10 px-3 rounded-full text-sm bg-white cursor-pointer flex gap-2 justify-start items-center">
                    <input type="file" name="" id="buktiPembayaran" class="hidden">
                    
                    <div class="w-7 h-7 rounded-full bg-mainColor text-white flex items-center justify-center">
                        <i class="fa-solid fa-download"></i>
                    </div>
                    
                    <p class="text-mediumGrey">Upload Bukti Pembayaran</p>
                </label>
            </div>

            <div class="flex flex-col gap-4 w-[70vw]">
                <div class="h-fit px-8 py-2 bg-red-600 text-white font-semibold rounded-md">
                    <p>Harap untuk membaca S&K sebelum melakukan pesanan</p>
                    <p>Apotek kami tidak menerima pengajuan refund untuk pesanan yang telah melewati masa batas pengambilan</p>
                </div>
                
                <div class="flex justify-start items-start gap-2 text-white text-base">
                    <input type="radio" name="snk" id="" class="w-6 h-6">
                    <p>Saya telah membaca dan memahami Syarat & Ketentuan Situs Apotek Jati Negara (yang dapat mengalami perubahan dari waktu ke waktu), dan dengan ini saya menyetujui untuk terikat pada ketentuan tersebut.</p>
                </div>
            </div>

            <div class="w-[70vw] flex justify-end text-white font-semibold gap-4">
                <button type="button" class="bg-red-600 h-fit w-fit px-10 py-1 rounded-lg shadow-md">
                    Kembali
                </button>
                <button onclick="showPopUp()" type="button" class="bg-mainColor h-fit w-fit px-10 py-1 rounded-lg shadow-md">
                    Kirim
                </button>
            </div>
        </div>
    </div>

    {{-- Pop up pembayaran start --}}
    <div class="absolute w-screen h-screen backdrop-blur-md top-0 left-0 flex justify-center items-center backdrop-brightness-75 hidden" id="popup">
        <div class="w-[30%] h-[50%] bg-white rounded-2xl shadow-md p-8 flex flex-col gap-6 relative">
            <div class="flex flex-col items-center">
                <svg xmlns="http://www.w3.org/2000/svg" class="text-secondaryColor icon icon-tabler icon-tabler-discount-check-filled" width="80" height="80" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M12.01 2.011a3.2 3.2 0 0 1 2.113 .797l.154 .145l.698 .698a1.2 1.2 0 0 0 .71 .341l.135 .008h1a3.2 3.2 0 0 1 3.195 3.018l.005 .182v1c0 .27 .092 .533 .258 .743l.09 .1l.697 .698a3.2 3.2 0 0 1 .147 4.382l-.145 .154l-.698 .698a1.2 1.2 0 0 0 -.341 .71l-.008 .135v1a3.2 3.2 0 0 1 -3.018 3.195l-.182 .005h-1a1.2 1.2 0 0 0 -.743 .258l-.1 .09l-.698 .697a3.2 3.2 0 0 1 -4.382 .147l-.154 -.145l-.698 -.698a1.2 1.2 0 0 0 -.71 -.341l-.135 -.008h-1a3.2 3.2 0 0 1 -3.195 -3.018l-.005 -.182v-1a1.2 1.2 0 0 0 -.258 -.743l-.09 -.1l-.697 -.698a3.2 3.2 0 0 1 -.147 -4.382l.145 -.154l.698 -.698a1.2 1.2 0 0 0 .341 -.71l.008 -.135v-1l.005 -.182a3.2 3.2 0 0 1 3.013 -3.013l.182 -.005h1a1.2 1.2 0 0 0 .743 -.258l.1 -.09l.698 -.697a3.2 3.2 0 0 1 2.269 -.944zm3.697 7.282a1 1 0 0 0 -1.414 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" stroke-width="0" fill="currentColor"></path>
                </svg>
                <p class="font-bold text-lg">Pesanan telah berhasil dibuat!</p>
            </div>

            <div class="flex flex-col gap-3">
                <p>Informasi pesanan :</p>

                <div class="">
                    <p>Nomor Invoice : <span class="font-bold">INV-000012323</span></p>
                    <p>Nama Pengambil : <span class="font-bold">Nama Pengambil</span></p>
                    <p>Tanggal Pesanan : <span class="font-bold">21 November 2023</span></p>
                    <p>Batas Pengambilan : <span class="font-bold">24 November 2023</span></p>
                </div>
            </div>

            <div class="flex justify-center">
                <button class="bg-mainColor px-16 rounded-lg shadow-md py-2 font-semibold text-white">Selesai</button>
            </div>

            <div class="">
                <button onclick="showPopUp()" class="text-mediumGrey opacity-70 text-3xl absolute top-4 right-6">
                    &#10005;
                </button>
            </div>
        </div>
    </div>
    {{-- Pop up pembayaran end --}}

    <script>
        const showPopUp = () => {
            const popup = document.getElementById('popup');

            if (popup.classList.contains('hidden')) {
                popup.classList.remove('hidden')
            } else {
                popup.classList.add('hidden')
            }
        }
    </script>
</body>
</html>