<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir | Riwayat Transaksi</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    {{-- DATATABLES --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

</head>
<body>
    @include("kasir.components.sidebar")
    <main class="p-10 font-Inter relative bg-plat min-h-[100vh] h-full" id="mainContent">
        @include("kasir.components.navbar")

        <div class="flex flex-col gap-8 mt-10">
            <p class="text-3xl font-bold">Riwayat Transaksi</p>

            <div class="bg-white rounded-lg p-4 shadow-md">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Invoice</th>
                            <th>Nama Penerima</th>
                            <th>Waktu Pemesanan</th>
                            <th>Total Harga</th>
                            <th>Status Pesanan</th>
                            <th>Detail Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 100; $i++)               
                        <tr>
                            <td>{{$i + 1}}</td>
                            <td>
                                <span class="font-bold">INV-12345</span>
                            </td>
                            <td>Nama Penerima Nama Penerima  {{$i + 1}}</td>
                            <td>24 Desember 2023</td>
                            <td>RP 650.000</td>
                            <td>
                                <div class="px-4 w-full flex gap-2 items-center">
                                    {{-- GREEN = BERHASIL, YELLOW = REFUND, RED = GAGAL --}}
                                    <i class="text-green-600 fa-solid fa-circle"></i>
                                    <i class="text-yellow-600 fa-solid fa-circle"></i>
                                    <i class="text-red-600 fa-solid fa-circle"></i>
                                    <p class="font-bold">Berhasil</p>
                                </div>
                            </td>
                            <td>
                                <div class="flex justify-center w-full">
                                    <button class="border-2 border-secondaryColor rounded-md hover:bg-transparent hover:text-secondaryColor font-bold px-4 py-1 bg-secondaryColor text-white duration-300 transition-colors ease-in-out">Lihat</button>
                                </div>
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
</body>
</html>