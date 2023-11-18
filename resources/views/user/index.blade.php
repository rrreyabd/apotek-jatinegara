<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ $title }}</title>
    @livewireStyles
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
</head>
<body class="font-Inter relative">
    @include('user.components.navbar')
    
    @include('user.components.carousel')
    
    @include('user.components.category')
    
    @auth
        @include('user.components.last-purchased')
    @endauth
    
    @include('user.components.banyak-dicari')
    
    @include('user.components.footer')

    @if (session('status') == 'pembayaran-berhasil')
        {{-- Pop up pembayaran start --}}
        <div class="absolute w-screen h-[100%] backdrop-blur-md top-0 left-0 flex justify-center items-center backdrop-brightness-75 overflow-x-auto" id="popup">
            <div class="w-[30%] h-[60%] bg-white rounded-2xl shadow-md p-8 flex flex-col gap-6 relative">
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
                        <p>Nomor Invoice : <span class="font-bold">{{ session('invoice_code') }}</span></p>
                        <p>Nama Pengambil : <span class="font-bold">{{ session('customer_name') }}</span></p>
                        <p>Tanggal Pesanan : <span class="font-bold">{{ date('d F Y',strtotime(NOW())) }}</span></p>
                        <p>Batas Pengambilan : <span class="font-bold">{{ date('d F Y',strtotime(NOW() . '3days')) }}</span></p>
                    </div>
                </div>

                <div class="flex justify-center">
                    <button onclick="showPopUp()" class="bg-mainColor px-16 rounded-lg shadow-md py-2 font-semibold text-white">Selesai</button>
                </div>
                
                <div class="">
                    <button onclick="showPopUp()" class="text-mediumGrey opacity-70 text-3xl absolute top-4 right-6">
                        &#10005;
                    </button>
                </div>
            </div>
        </div>
        {{-- Pop up pembayaran end --}}
        @elseif(session('status') == 'pembayaran-gagal')
        <div class="absolute w-screen h-[100%] backdrop-blur-md top-0 left-0 flex justify-center items-center backdrop-brightness-75" id="popup">
            <div class="w-[30%] h-[40%] bg-white rounded-2xl shadow-md p-8 flex flex-col gap-6 relative">
                <div class="flex flex-col items-center">
                    <svg xmlns="http://www.w3.org/2000/svg" class="text-secondaryColor icon icon-tabler icon-tabler-discount-check-filled" width="80" height="80" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                        <path d="M12.01 2.011a3.2 3.2 0 0 1 2.113 .797l.154 .145l.698 .698a1.2 1.2 0 0 0 .71 .341l.135 .008h1a3.2 3.2 0 0 1 3.195 3.018l.005 .182v1c0 .27 .092 .533 .258 .743l.09 .1l.697 .698a3.2 3.2 0 0 1 .147 4.382l-.145 .154l-.698 .698a1.2 1.2 0 0 0 -.341 .71l-.008 .135v1a3.2 3.2 0 0 1 -3.018 3.195l-.182 .005h-1a1.2 1.2 0 0 0 -.743 .258l-.1 .09l-.698 .697a3.2 3.2 0 0 1 -4.382 .147l-.154 -.145l-.698 -.698a1.2 1.2 0 0 0 -.71 -.341l-.135 -.008h-1a3.2 3.2 0 0 1 -3.195 -3.018l-.005 -.182v-1a1.2 1.2 0 0 0 -.258 -.743l-.09 -.1l-.697 -.698a3.2 3.2 0 0 1 -.147 -4.382l.145 -.154l.698 -.698a1.2 1.2 0 0 0 .341 -.71l.008 -.135v-1l.005 -.182a3.2 3.2 0 0 1 3.013 -3.013l.182 -.005h1a1.2 1.2 0 0 0 .743 -.258l.1 -.09l.698 -.697a3.2 3.2 0 0 1 2.269 -.944zm3.697 7.282a1 1 0 0 0 -1.414 0l-3.293 3.292l-1.293 -1.292l-.094 -.083a1 1 0 0 0 -1.32 1.497l2 2l.094 .083a1 1 0 0 0 1.32 -.083l4 -4l.083 -.094a1 1 0 0 0 -.083 -1.32z" stroke-width="0" fill="currentColor"></path>
                    </svg>
                    <p class="font-bold text-lg">Pesanan gagal dibuat!</p>
                    <p class="font-bold text-lg">Silahkan Melakukan Pemesanan Kembali!</p>
                </div>

                <div class="flex justify-center">
                    <button onclick="showPopUp()" class="bg-mainColor px-16 rounded-lg shadow-md py-2 font-semibold text-white">Selesai</button>
                </div>
                
                <div class="">
                    <button onclick="showPopUp()" class="text-mediumGrey opacity-70 text-3xl absolute top-4 right-6">
                        &#10005;
                    </button>
                </div>
            </div>
        </div>
        @endif
        
    <script>
        const showPopUp = () => {
            const popup = document.getElementById('popup');

            if (popup.classList.contains('hidden')) {
                popup.classList.remove('hidden')
                document.body.classList.add('h-[100vh]')
                document.body.classList.add('overflow-hidden')
            } else {
                popup.classList.add('hidden')
                document.body.classList.remove('h-[100vh]')
                document.body.classList.remove('overflow-hidden')
            }
        }
    </script>
    
    @livewireScripts
</body>
</html>