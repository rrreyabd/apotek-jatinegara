<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir | Pesanan Online</title>
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
<body class="font-Inter relative">
    @include("kasir.components.sidebar")
    <main class="p-10 font-Inter bg-plat min-h-[100vh] h-full" id="mainContent">
        @include("kasir.components.navbar")

        <div class="flex flex-col gap-8 mt-10">
            <p class="text-3xl font-bold">Pesanan Online</p>

            <div class="bg-white rounded-lg p-4 shadow-md">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nama Pengambil</th>
                            <th>Nomor HP</th>
                            <th>Metode Pembayaran</th>
                            <th>Bukti Transfer</th>
                            <th>Total</th>
                            <th>Detail Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 50; $i++)               
                        <tr>
                            <td>{{$i + 1}}</td>
                            <td>
                                <span class="font-bold">Agus {{$i}}</span>
                            </td>
                            <td>0812-1234-1234</td>
                            <td>BCA</td>
                            <td>
                                <a href="/cashier/img" target="_blank" class="text-blue-600 underline">Screenshot192.jpg</a>
                            </td>
                            <td>
                                <p class="font-bold">Rp 150.000.000</p>
                            </td>
                            <td>
                                <div class="flex justify-center w-full">
                                    <button class="border-2 border-secondaryColor rounded-md hover:bg-transparent hover:text-secondaryColor font-bold px-4 py-1 bg-secondaryColor text-white duration-300 transition-colors ease-in-out" type="button" onclick="toggleDetail()">Lihat</button>
                                </div>

                                {{-- MODAL DETAIL PESANAN ONLINE START --}}
                                <div class="absolute w-full h-[100%] top-0 left-0 flex justify-center items-center backdrop-brightness-75 z-10 py-8 hidden" id="detailModal">
                                    <div class="w-[70%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-6 overflow-auto">
                                        <div class="flex justify-start items-center">
                                            <button onclick="toggleDetail()" type="button" class="bg-mainColor py-1 px-4 text-white font-semibold rounded-md">
                                                <i class="fa-solid fa-arrow-left"></i>
                                                Kembali
                                            </button>
                                        </div>
    
                                        <div class="px-8 py-2 w-[100%] flex justify-between">
                                            <div class="w-[70%]">
                                                <div class="flex flex-col gap-8">
                                                    <div class="overflow-y-auto h-96">
                                                        <table class="w-full h-full overflow-scroll">
                                                            <tr class="border-2 border-b-mainColor border-transparent text-mainColor font-bold w-[100%]">
                                                                <td class="w-[10%] pb-2 text-center">No</td>
                                                                <td class="w-[30%] pb-2">Nama</td>
                                                                <td class="w-[10%] pb-2 text-center">Jumlah</td>
                                                                <td class="w-[25%] pb-2 text-center">Resep Dokter</td>
                                                            </tr>
                                                            @for ($j = 0; $j < 50; $j++)              
                                                            <tr>
                                                                <td class="py-2 text-center">1</td>
                                                                <td class="py-2">Paracetamol 200 kg</td>
                                                                <td class="py-2 text-center">4</td>
                                                                <td class="py-2 text-center">Tidak Perlu</td>
                                                            </tr>
                                                            @endfor
                                                        </table>
                                                    </div>
                                                </div>
                                            </div>
    
                                            <div class="w-[25%] flex flex-col justify-between gap-8">
                                                <div class="">
                                                    <p class="text-center font-bold text-mainColor pb-2">Catatan</p>
                                                    <hr class="border-2 border-transparent border-b-mainColor">
                                                    <p>Pesanan diambil besok sekitar jam 3 ya kak.</p>
                                                </div>
    
                                                <div class="">
                                                    <p class="text-center font-bold text-mainColor pb-2">Resep Dokter</p>
                                                    <hr class="border-2 border-transparent border-b-mainColor">
                                                    <div class="mt-2">
                                                        <a href="/cashier/img" target="_blank" class="text-blue-600 underline">resepdokter.mp4</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
    
                                        <div class="flex justify-between">
                                            <button onclick="modalTolak()" class="bg-red-600 font-semibold text-xl text-white px-8 py-1 rounded-md">Tolak</button>
                                            <button onclick="modalRefund()" class="bg-yellow-500 font-semibold text-xl text-white px-8 py-1 rounded-md">Refund</button>
                                            <button onclick="modalTerima()" class="bg-green-600 font-semibold text-xl text-white px-8 py-1 rounded-md">Terima</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- MODAL DETAIL PESANAN ONLINE END --}}
    
                                {{-- MODAL TOLAK START --}}
                                <div class="absolute w-full h-[100%] top-0 left-0 flex justify-center items-center backdrop-brightness-50 z-10 hidden" id="modalTolak">
                                    <div class="w-[30%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-8 overflow-auto items-center text-center">
                                        <i class="text-red-600 text-6xl fa-solid fa-exclamation"></i>
                                        
                                        <div class="text-center flex items-center flex-col gap-2">
                                            <p class="font-bold text-2xl w-[80%]">Apakah Anda Yakin Ingin <span class="text-mainColor">Menolak</span> Pesanan Yoona?</p>
                                            
                                            <p class="text-red-600 font-semibold w-[80%] text-sm">Penolakan Pesanan Hanya Dilakukan Di Kondisi Tertentu</p>
                                        </div>
    
                                        <div class="flex justify-between w-[70%]">
                                            <button onclick="modalTolak()" type="button" class="bg-green-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Tidak</button>
                                            <form action="">
                                                <button type="submit" class="bg-red-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Ya</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- MODAL TOLAK END --}}
    
                                {{-- MODAL TERIMA START --}}
                                <div class="absolute w-full h-[100%] top-0 left-0 flex justify-center items-center backdrop-brightness-50 z-10 hidden" id="modalTerima">
                                    <div class="w-[30%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-8 overflow-auto items-center text-center">
                                        <i class="text-green-600 text-6xl fa-solid fa-exclamation"></i>
                                        
                                        <div class="text-center flex items-center flex-col gap-2">
                                            <p class="font-bold text-2xl w-[80%]">Apakah Anda Yakin Ingin <span class="text-mainColor">Menerima</span> Pesanan Yoona?</p>
                                        </div>
    
                                        <div class="flex justify-between w-[70%]">                                            
                                            <button onclick="modalTerima()" type="button" class="bg-red-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Tidak</button>
                                            <form action="">
                                                <button type="submit" class="bg-green-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Ya</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- MODAL TERIMA END --}}
    
                                {{-- MODAL REFUND START --}}
                                <div class="absolute w-full h-[100%] top-0 left-0 flex justify-center items-center backdrop-brightness-50 z-10 hidden" id="modalRefund">
                                    <div class="w-[30%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-8 overflow-auto items-center text-center">
                                        <i class="text-yellow-600 text-6xl fa-solid fa-exclamation"></i>
                                        
                                        <div class="text-center flex items-center flex-col gap-2">
                                            <p class="font-bold text-2xl w-[80%]">Apakah Anda Yakin Ingin <span class="text-mainColor">Mengembalikan</span> Pesanan Yoona?</p>
                                        </div>
    
                                        <div class="flex justify-between w-[70%]">
                                            <button onclick="modalRefund()" type="button" class="bg-green-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Tidak</button>
                                            <form action="">
                                                <button type="button" onclick="modalAlasanRefund()" class="bg-red-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Ya</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- MODAL REFUND END --}}
    
    
                                {{-- MODAL ALASAN REFUND START --}}
                                <div class="absolute w-full h-[100%] top-0 left-0 flex justify-center items-center backdrop-brightness-50 z-20 hidden" id="alasanRefund">
                                    <div class="w-[30%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-8 overflow-auto items-center text-center">
                                        <p class="text-3xl font-bold text-mainColor">Input Alasan Tolak Pesanan</p>
                                        <form action="" class="w-[100%] flex items-center flex-col gap-4">
                                            <textarea name="" id="" rows="10" class="border-2 border-mediumGrey border-opacity-50 rounded-md p-4 w-full"></textarea>
                                            <div class="flex justify-between w-[70%]">
                                                <button onclick="modalAlasanRefund()" type="button" class="bg-red-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Batal</button>
                                                <button type="submit" class="bg-green-600 w-[8rem] px-8 py-2 font-semibold text-xl text-white rounded-md">Kirim</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                {{-- MODAL ALASAN REFUND END --}}
                            </td>
                        </tr>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>
        const toggleDetail = () => {
            const modal = document.getElementById('detailModal');

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden')
            } else {
                modal.classList.add('hidden')
            }
        }

        const modalTolak = () => {
            const modal = document.getElementById('modalTolak');

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden')
            } else {
                modal.classList.add('hidden')
            }
        }

        const modalRefund = () => {
            const modal = document.getElementById('modalRefund');

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden')
            } else {
                modal.classList.add('hidden')
            }
        }

        const modalTerima = () => {
            const modal = document.getElementById('modalTerima');

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden')
            } else {
                modal.classList.add('hidden')
            }
        }

        const modalAlasanRefund = () => {
            const modal = document.getElementById('alasanRefund');

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden')
            } else {
                modal.classList.add('hidden')
            }
        }
    </script>
</body>
</html>