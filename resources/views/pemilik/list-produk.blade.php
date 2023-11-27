<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilik Apotek | Produk</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    {{-- DATATABLES --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />
    {{-- <style>
        *{
            border: 2px red solid;
        }
    </style> --}}
</head>

<body class="font-Inter relative">
    @include('pemilik.components.sidebar')
    <main class="p-10 font-Inter bg-plat min-h-[100vh] h-full" id="mainContent">
        @include('pemilik.components.navbar')

        <div class="flex flex-col gap-8 mt-10">
            <div class="md:flex justify-between">
                <p class="text-3xl font-bold mb-2">List Produk</p>

                <a href="{{ route('add-product') }}" class="px-6 py-2.5 rounded-lg bg-mainColor text-white font-semibold">
                    <i class="fa-solid fa-plus pe-2"></i>
                    Tambah Produk
                </a>
            </div>

                <div class="bg-white rounded-lg p-4 shadow-md overflow-x-auto">
                    <table id="myTable" class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Produk</th>
                                <th>Stok</th>
                                <th>Tanggal Expired</th>
                                <th>Status Obat</th>
                                <th>Detail Obat</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $i = 1;
                            @endphp
                            @foreach ($product as $item)
                                
                            <tr>
                                <td>{{$i++}}</td>
                                <td>
                                    <span class="font-bold">{{ $item->product_name }}</span>
                                </td>
                                @php
                                    $carbonDate = \Carbon\Carbon::parse( $item->detail()->orderBy('product_expired')->first()->product_expired);
                                    $formattedDate = $carbonDate->format('j F Y');
                                @endphp
                                <td>{{ $item->detail()->orderBy('product_expired')->first()->product_stock }}</td>
                                <td>{{ $formattedDate }}</td>
                                <td>
                                    {{ $item->product_status }}
                                </td>
                                <td>
                                    <a href="{{ route('product-detail',['id'=> $item->product_id]) }}"
                                    class="border-2 border-secondaryColor rounded-md hover:bg-transparent hover:text-secondaryColor font-bold px-4 py-1 bg-secondaryColor text-white duration-300 transition-colors ease-in-out">
                                    Lihat
                                </a>
                            </td>
                                <td>
                                    <a href="{{ route('product-edit',['id'=> $item->product_id]) }}" class="p-2 bg-secondaryColor rounded mx-2"><i
                                        class="fa-regular fa-pen-to-square" style="color: white;"></i></a>
                                        <button onclick="showPopUpDelete()" class="p-2 bg-mediumRed rounded mx-2"><i class="fa-regular fa-trash-can"
                                            style="color: white;"></i></button>
                                            
                                            {{-- Pop up konfirmasi hapus start --}}
                                            <div class="absolute w-screen h-full backdrop-blur-md top-0 left-0 flex justify-center items-center backdrop-brightness-75 hidden" id="popup">
                                                <div class="w-[30%] h-[50%] bg-white rounded-2xl shadow-md p-8 flex flex-col gap-6 relative items-center">
                                                    <div class="border-2 border-mainColor rounded-full w-fit">
                                                        <i class="fa-solid fa-question fa-2xl p-8 py-10" style="color: #1A8889;"></i>
                                                    </div>
                                                    
                                                    <p class="text-2xl text-mainColor font-TripBold text-center">Apakah Anda Yakin Ingin Menghapus soeharto?</p>
                                                    
                                                    <div class="flex gap-4">
                                                    <form action="{{ route('product-delete',['id'=> $item->product_id]) }}" method="get">
                                                        <button onclick="showPopUpDelete()" class="bg-mediumRed text-white text-2xl p-1 px-5 rounded-lg">Tidak</button>
                                                        <button type="submit" class="bg-green-600 text-white text-2xl p-1 px-10 rounded-lg">Ya</button>
                                                    </form>
                                                    </div>
                                                </div>
                                            </div>
                                            {{-- Pop up konfirmasi hapus end --}}
                                        </td>
                                    </tr>
                            @endforeach            
                        </tbody>
                    </table>
                </div>
        </div>
    </main>

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>
        const showPopUpDelete = () => {
            const popup = document.getElementById('popup');

            if (popup.classList.contains('hidden')) {
                popup.classList.remove('hidden')
            } else {
                popup.classList.add('hidden')
            }
        }

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