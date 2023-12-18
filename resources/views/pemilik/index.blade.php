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
    {{-- FLATPICKR.JS --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

    {{-- CHART.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    {{-- flatpickr.js --}}
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
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
                            <p class="text-lg font-bold">{{ $pending }}</p>
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
                            <p class="text-lg font-bold">{{ $product }}</p>
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
                            <p class="text-lg font-bold">{{ $user }}</p>
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
                            <p class="text-lg font-bold">{{ $supplier }}</p>
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
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($popular as $item)
                                
                            <tr class="md:flex justify-between items-center gap-8">
                                <td>{{$i++}}</td>
                                <td class="w-[160px] h-[140px] invisible">
                                    <img src="{{asset('img/obat1.jpg')}}" alt="" class="sm:visible w-25 p-5">
                                </td>
                                <td class="w-80">
                                    <p class="font-bold">{{ $item->product_name }}</p>
                                </td>
                                <td>
                                    <p class="font-bold text-mainColor">{{ $item->jumlah_kemunculan }}</p>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="bg-white p-8 rounded-lg shadow-lg w-full flex flex-col items-center justify-center">
                    <p class="text-xl font-bold">Laporan Keuntungan</p>

                    {{-- line --}}
                    <div class="w-[90%] shadow border border-mainColor my-3"></div>

                    {{-- chart start --}}
                    <canvas id="myChart" width="400" height="350"></canvas>

                    <script>
                        var ctx = document.getElementById('myChart').getContext('2d');
                
                        var labels = <?php echo json_encode(array_column($results, 'year')); ?>;
                        var data = <?php echo json_encode(array_column($results, 'total_profit')); ?>;

                        var myChart = new Chart(ctx, {
                            type: 'bar',
                            data: {
                                labels: labels,
                                datasets: [{
                                    label: 'Total Profit',
                                    data: data,
                                    backgroundColor: 'rgb(26 136 137)',
                                    borderColor: 'rgba(75, 192, 192, 1)',
                                    borderWidth: 1
                                }]
                            },
                            options: {
                            scales: {
                                x: [{
                                    ticks: {
                                        autoSkip: false, 
                                        maxRotation: 0, 
                                        minRotation: 0  
                                    }
                                }],
                                y: {
                                    beginAtZero: true
                                }
                            }
                        }
                        });
                    </script>
                    {{-- chart end --}}

                </div>
            </div>

            <p class="font-bold text-2xl mt-5">Transaksi Terakhir</p>
            <livewire:transaksi-terakhir/>
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