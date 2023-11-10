<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=\, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Riwayat Pesanan</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
</head>

<body class="font-Trip">
    @include('user.components.secondNavbar')

    
    <div class="flex flex-col items-center mb-8">

        <div class="w-[70vw] mt-8 flex flex-col">
            <div class="flex gap-4">
                {{-- back button --}}
                <button onclick=""
                class="flex justify-start items-center rounded-3xl shadow-md h-[40px] px-3 text-center text-lg text-gray-500 font-semibold">
                <svg xmlns="http://www.w3.org/2000/svg" class="pe-1" width="24" height="24" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none">
                    <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                    <path d="M9 14l-4 -4l4 -4"></path>
                    <path d="M5 10h11a4 4 0 1 1 0 8h-1"></path>
                </svg>
                Kembali</button>
            </div>
            <p class="my-7 mb-3 text-3xl font-semibold">Detail Pesanan - INV-00012323</p>
            @if(true)
            <p class="w-fit rounded-lg p-1.5 px-4 bg-green-700 text-white font-semibold">Berhasil</p>
            @elseif(false)
            <p class="w-fit rounded-lg p-1.5 px-4 bg-red-600 text-white font-semibold">Gagal</p>
            @else
            <p class="w-fit rounded-lg p-1.5 px-4 bg-secondaryColor text-white font-semibold">Refund</p>
            @endif
            <p class="my-7 mb-3 text-xl font-semibold">Informasi Pesanan</p>

            <div class="bg-tertiaryColor rounded-lg">
                <div class="flex grid-cols-3 gap-4 justify-between p-5 overflow-x-auto">
                    <div>
                        <p>Tanggal Pemesanan : 24 September 2023</p>
                        <p class="my-2">No. Handphone : 0812</p> 
                        <p>Resep Dokter : -</p>
                         </div>
                    <div>
                        <p>Nama Penerima : namaku</p> 
                        <p class="my-2">Batas Pengambilan : 27 September 2023</p>
                        <p>Tanggal Pengambilan : 26 September 2023</p>
                    </div>
                    <div>
                        <p>Catatan Tambahan</p>
                        <div class="bg-white shadow-lg rounded-lg p-2 mt-1">pinjam dulu seratus</div>
                    </div>
                </div>
            </div>

            <div class="sm:flex my-7 mb-3 text-xl ">
            <p class="font-semibold me-2">Informasi Pembayaran:</p>
            <a href="" class="underline me-1 text-lg">
                <i class="fa-solid fa-note-sticky"></i>
                Screenshot1.jpg</a>
                <p class="text-lg">(Bank Mandiri)</p>
            </div>

            <div class="sm:flex sm:grid-col-2 my-5">
                <p class="text-xl font-semibold me-2 w-1/5">Alasan Penolakan:</p>
                <div class="shadow-md w-4/5 p-2 rounded-lg min-h-[80px]">
                    Tidak direstui orang tua
                </div>
            </div>
            
            <p class="text-xl font-semibold me-2 w-1/4 mt-4">Daftar Pesanan:</p>

            {{-- table --}}
            <div class="shadow-lg rounded-lg w-full h-fit my-3">
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-mainColor text-white">
                            <tr>
                                <th class="p-3 rounded-tl-lg" scope="col">Nama Produk</th>
                                <th scope="col">Harga</th>
                                <th scope="col">Kuantitas</th>
                                <th class="p-3 rounded-tr-lg max-w-1/5" scope="col">Total Harga</th>
                            </tr>
                        </thead>

                        <tbody class="border-t">
                            <tr>
                                <th class="py-2" scope="row">
                                    <p>Paracetamol 500 mg </p>
                                </th>
                                <th>
                                    <p>Rp 10.000</p>
                                </th>
                                <th>
                                    <p class="text-lg">4</p>
                                </th>
                                <th>
                                    <p class="text-lg">Rp 40.000</p>
                                </th>
                            </tr>
                        </tbody>
                        <tfoot class="border-t">
                            <tr class="bg-tertiaryColor">
                                <th></th>
                                <th></th>
                                <th></th>
                                <th class="py-2">Total Belanja : Rp. 90.000</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>

        </div>
    </div>
    @include('user.components.footer')
</body>

</html>