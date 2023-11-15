<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilik Apotek | Home</title>
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

        <div class="flex flex-col gap-8">
            <div class="md:flex gap-4 items-center">
                {{-- toggle --}}
                <button onclick="sidebar()" class="p-3 px-4 rounded-lg shadow-md bg-white w-fit z-10"
                    style="transition: 0.25s;" id="buttonToggle">
                    <i class="fa-solid fa-bars" id="toggle"></i>
                </button>

                <p class="text-3xl font-bold absolute ms-16">Dashboard</p>
            </div>

            <div class="md:flex gap-6 justify-between">
                <div class="bg-white p-8 rounded-lg shadow-lg w-full">
                    <div class="flex gap-8 md:justify-center items-center">
                        <div class="border-2 border-mainColor p-3 py-4 rounded-full ms-3">
                            <i class="fa-solid fa-spinner fa-2xl" style="color:#1A8889;"></i>
                        </div>
                        <div class="items-center">
                            <p class="text-md text-mediumGrey font-bold">Pesanan Menunggu Pengembalian</p>
                            <p class="text-lg font-bold">5</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg w-full">
                    <div class="flex gap-8 items-center ">
                        <div class="border-2 border-mainColor p-5 py-5.5 rounded-full items-center ms-3">
                            <i class="fa-solid fa-prescription-bottle-medical fa-2xl" style="color:#1A8889;"></i>
                        </div>
                        <div class="items-center">
                            <p class="text-md text-mediumGrey font-bold">Produk</p>
                            <p class="text-lg font-bold">100</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg w-full">
                    <div class="flex gap-8 items-center ">
                        <div class="border-2 border-mainColor p-3 py-5 rounded-full items-center ms-3">
                            <i class="fa-solid fa-users fa-2xl" style="color:#1A8889;"></i>
                        </div>
                        <div class="items-center">
                            <p class="text-md text-mediumGrey font-bold">User</p>
                            <p class="text-lg font-bold">25</p>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg w-full">
                    <div class="flex gap-8 items-center ">
                        <div class="border-2 border-mainColor p-3 py-5 rounded-full items-center ms-3">
                            <i class="fa-solid fa-truck fa-2xl" style="color:#1A8889;"></i>
                        </div>
                        <div class="items-center">
                            <p class="text-md text-mediumGrey font-bold">Supplier</p>
                            <p class="text-lg font-bold">20</p>
                        </div>
                    </div>
                </div>
            </div>

            <div class="md:flex gap-6">
                <div class="bg-white p-8 rounded-lg shadow-lg w-full flex flex-col items-center justify-center">
                    <p class="text-xl font-bold">Produk Populer</p>

                    {{-- line --}}
                    <div class="w-[90%] shadow border border-mainColor my-3"></div>

                    <table>
                        <tbody>
                            @for ($i = 0; $i < 3; $i++) 
                            <tr class="md:flex justify-between items-center gap-8">
                                <td>{{$i + 1}}</td>
                                <td class="w-[160px] h-[140px] invisible">
                                    <img src="{{asset('img/obat1.jpg')}}" alt="" class="sm:visible w-25 p-5">
                                </td>
                                <td>
                                    <p class="font-bold">Paracetamol 500 mg</p>
                                </td>
                                <td>
                                    <p class="font-bold text-mainColor">530 Pembeli</p>
                                </td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg w-full flex flex-col items-center justify-center">
                    <p class="text-xl font-bold">Laporan Penjualan</p>

                    {{-- line --}}
                    <div class="w-[90%] shadow border border-mainColor my-3"></div>

                    {{-- chart start --}}
                    
                    {{-- chart end --}}

                </div>
            </div>

            <p class="font-bold text-2xl mt-5">Transaksi Terakhir</p>
            <input type="month" name="" id="tgl-transaksi" class="w-fit p-3 rounded-lg shadow-lg border-none">

            <div class="bg-white rounded-lg p-4 shadow-md overflow-x-auto">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Tanggal Transaksi</th>
                            <th>No. Invoice</th>
                            <th>Tipe Transaksi</th>
                            <th>Metode Pembayaran</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 6; $i++) <tr>
                            <td>{{$i + 1}}</td>
                            <td>
                                <span class="font-bold">24 September 2023</span>
                            </td>
                            <td>INV-123321</td>
                            <td>Pembelian</td>
                            <td>Tunai</td>
                            <td>Rp
                                {{-- {{ number_format($jumlah , 0, ',', '.') }} --}}
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
    <script src=" {{asset('js/datatables.js')}}"></script>

    {{-- CHART SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src=" {{asset('js/chart.js')}}"></script>

    <script>
        // disable future date
        var today = new Date();
        var year = today.getFullYear();
        var month = (today.getMonth() + 1).toString().padStart(2, '0');
        var maxDate = year + '-' + month;
        document.getElementById('tgl-transaksi').setAttribute('max', maxDate);
    </script>
</body>

</html>