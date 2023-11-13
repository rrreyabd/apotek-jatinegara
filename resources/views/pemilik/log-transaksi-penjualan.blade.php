<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilik Apotek | Kasir</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    {{-- DATATABLES --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
</head>

<body class="font-Inter relative">
    @include('pemilik.components.sidebar')
    <main class="p-10 font-Inter bg-plat min-h-[100vh] h-full" id="mainContent">
        @include('pemilik.components.navbar')

        <div class="flex flex-col gap-8 mt-10">
            <p class="text-3xl font-bold">Log Transaksi Penjualan</p>

            <div class="bg-white rounded-lg p-4 shadow-md overflow-x-auto">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama Pembeli</th>
                            <th>Tanggal Transaksi</th>
                            <th>Nomor Invoice</th>
                            <th>Status Transaksi</th>
                            <th>Detail Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 6; $i++) <tr>
                            <td>{{$i + 1}}</td>
                            <td>
                                <span class="font-bold">Agus</span>
                            </td>
                            <td>25 September 2023</td>
                            <td>INV-12345</td>
                            <td>
                                <div class="w-full flex gap-2 items-center">
                                    {{-- GREEN = BERHASIL, YELLOW = REFUND, RED = GAGAL --}}
                                    <i class="text-green-600 fa-solid fa-circle"></i>
                                    <i class="text-yellow-600 fa-solid fa-circle"></i>
                                    <i class="text-red-600 fa-solid fa-circle"></i>
                                    <p class="font-bold">Berhasil</p>
                                </div>
                            </td>
                            <td>
                                <div class="flex w-full">
                                    <button class="border-2 border-secondaryColor rounded-md hover:bg-transparent hover:text-secondaryColor font-bold px-4 py-1 bg-secondaryColor text-white duration-300 transition-colors ease-in-out" type="button" onclick="toggleDetail()">Lihat</button>
                                </div>

                                {{-- MODAL DETAIL PESANAN PENDING START --}}
                                {{-- masih copy, nanti aku sesuaikan --}}
                                <div class="absolute w-full h-screen top-0 left-0 flex justify-center items-center backdrop-brightness-75 z-10 hidden" id="detailModal">
                                    <div class="w-[70%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-6 overflow-auto">
                                        <div class="">
                                            <button onclick="toggleDetail()" type="button" class="bg-mainColor py-1 px-4 text-white font-semibold rounded-md">
                                                <i class="fa-solid fa-arrow-left"></i>
                                                Kembali
                                            </button>
                                        </div>
    
                                        <div class="px-8 py-2 w-[100%] flex justify-between">
                                            <div class="w-[70%]">
                                                <table class="w-full">
                                                    <tr class="border-2 border-b-mainColor border-transparent text-mainColor font-bold w-[100%]">
                                                        <td class="w-[10%] pb-2 text-center">No</td>
                                                        <td class="w-[50%] pb-2">Nama</td>
                                                        <td class="w-[20%] pb-2 text-center">Jumlah</td>
                                                        <td class="w-[20%] pb-2">Resep Dokter</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 text-center">1</td>
                                                        <td class="py-2">Paracetamol 200 kg</td>
                                                        <td class="py-2 text-center">4</td>
                                                        <td class="py-2">Perlu</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 text-center">2</td>
                                                        <td class="py-2">Panadol 200 mg</td>
                                                        <td class="py-2 text-center">3</td>
                                                        <td class="py-2">Tidak Perlu</td>
                                                    </tr>
                                                </table>
                                            </div>
    
                                            <div class="w-[25%]">
                                                <table class="w-full">
                                                    <tr class="border-2 border-b-mainColor border-transparent text-mainColor font-bold w-[100%]">
                                                        <td class="pb-2">File Resep Dokter</td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-2 flex gap-2 items-center">
                                                            <i class="fa-solid fa-image"></i>
                                                            <a href="/cashier/img" target="_blank">resepDokter.jpg</a>
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                        </div>
    
                                        <div class="px-8 w-[100%]">
                                            <p class="text-mainColor font-bold py-2 border-2 border-b-mainColor border-transparent">Catatan</p>
                                            <p class="py-4">Obat A dan C digabung di satu tempat, Obat B dan D dibuang.</p>
                                        </div>
    
                                        <div class="flex justify-end w-full">
                                            <form action="">
                                                <button class="bg-green-600 text-white font-bold py-2 px-4 rounded-md shadow-md">Tandai Selesai</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- MODAL DETAIL PESANAN PENDING END --}}
                            </td>
                            </tr>
                            @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js"
        crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>
       const toggleDetail = () => {
            const modal = document.getElementById('detailModal');

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden')
                document.body.classList.add('h-[100vh]')
            } else {
                modal.classList.add('hidden')
                document.body.classList.remove('h-[100vh]')
            }
        }
    </script>
</body>

</html>