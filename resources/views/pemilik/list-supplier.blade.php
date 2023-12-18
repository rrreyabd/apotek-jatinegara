<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilik Apotek | Supplier</title>
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
            <div class="md:flex justify-between mb-5">
                <div>
                    <p class="text-3xl font-bold mb-2">List Supplier</p>

                    @if (session('error'))
                        @foreach (session('error') as $error)
                            <div class="text-md text-mediumRed">{{ $error[0] }}</div>
                        @endforeach
                    @endif
                </div>

                @if (session('add_status'))
                    <div class="absolute top-4 left-[42.5vw] bg-mainColor shadow-md w-[25vw] h-14 z-20 gap-2 items-center px-4 animate-notif opacity-0 justify-center rounded-md flex unselectable">
                        <i class="text-white fa-solid fa-circle-check"></i>
                        <p class="text-lg text-white font-semibold"> {{ session('add_status') }} </p>
                    </div>
                @elseif (session('error_status'))
                    <div class="absolute top-4 left-[42.5vw] bg-red-500 shadow-md w-[25vw] h-14 z-20 gap-2 items-center px-4 animate-notif opacity-0 justify-center rounded-md flex unselectable">
                        <i class="text-white fa-solid fa-circle-check"></i>
                        <p class="text-lg text-white font-semibold"> {{ session('error_status') }} </p>
                    </div>
                @endif

                <button onclick="showTambahData()" class="px-6 h-12 py-2.5 rounded-lg bg-mainColor text-white font-semibold">
                    <i class="fa-solid fa-plus pe-2"></i>
                    Tambah Supplier
                </button>
            </div>

            {{-- MODAL TAMBAH SUPPLIER START --}}
            <div class="top-0 left-0 hidden flex flex-col justify-center items-center absolute z-10 backdrop-blur-sm backdrop-brightness-75 rounded-xl w-full h-screen"
                id="tambahDataSupplier">
                <div class="w-fit flex flex-col justify-center">
                    <div class="bg-mainColor text-white font-semibold px-10 py-4 rounded-t-xl flex justify-between">
                        Tambah Supplier
                        <button onclick="showTambahData()">
                        <i class="fa-solid fa-xmark fa-xl" style="color: white"></i>
                        </button>
                    </div>
                    <div class="bg-white p-7 rounded-b-xl">
                        <form action="{{ route('add-supplier') }}" method="post">
                            @csrf
                            @method('put')
                            <div class="flex gap-6 p-4">
                                <table>
                                    <tr>
                                        <td><label for="namaSupplier">Nama Supplier</label></td>
                                        <td class="ps-5"><input type="text" class="p-2 px-4 rounded-xl shadow border @error('nama_supplier') is-invalid @enderror" required value="{{ old('nama_supplier') }}" name="nama_supplier"></td>
                                        @error('nama_supplier')
                                            <div class="text-xs text-mediumRed">{{ $message }}</div>
                                        @enderror
                                    </tr>
                                    <tr>
                                        <td class="py-5"><label for="noTelpSupplier">No Telp Supplier</label></td>
                                        <td class="ps-5"><input type="number" class="p-2 px-4 rounded-xl shadow border @error('no_telp') is-invalid @enderror" required value="{{ old('no_telp') }}" name="no_telp"></td>
                                        @error('no_telp')
                                            <div class="text-xs text-mediumRed">{{ $message }}</div>
                                        @enderror
                                    </tr>
                                    <tr>
                                        <td class="py-5"><label for="alamatSupplier">Alamat Supplier</label></td>
                                        <td class="ps-5"><input type="text" class="p-2 px-4 rounded-xl shadow border @error('alamat') is-invalid @enderror" required value="{{ old('alamat') }}" name="alamat"></td>
                                        @error('alamat')
                                            <div class="text-xs text-mediumRed">{{ $message }}</div>
                                        @enderror
                                    </tr>
                                </table>
                            </div>
                            <div class="flex justify-end">
                                <button type="submit"
                                    class="p-2 px-4 me-4 bg-secondaryColor text-white font-semibold rounded-lg">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            {{-- MODAL TAMBAH SUPPLIER END --}}
        </div>

        <div class="bg-white rounded-lg p-4 shadow-md overflow-x-auto">
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>Nomor Telepon</th>
                        <th>Alamat Supplier</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                        $index = 1;
                    @endphp
                    @foreach ($suppliers as $item)
                        
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            <span class="font-bold">{{ $item->supplier }}</span>
                        </td>
                        <td>{{ $item->supplier_phone }}</td>
                        <td>{{ $item->supplier_address }}</td>
                        <td>
                            <div class="flex">
                                <button onclick="showPopUpEdit({{ $index }})" class="p-2 bg-secondaryColor rounded mx-2"><i
                                class="fa-regular fa-pen-to-square" style="color: white;"></i></button>
                                <button onclick="showPopUpDelete({{ $index }})" class="p-2 bg-mediumRed rounded mx-2"><i
                                    class="fa-regular fa-trash-can" style="color: white;"></i></button>
                            </div>
                                    
                                    {{-- Pop up konfirmasi hapus start --}}
                                    <div class="absolute w-screen h-screen backdrop-blur-md top-0 left-0 flex justify-center items-center backdrop-brightness-75 hidden"
                                    id="popupHapus{{ $index }}">
                                    <div
                                    class="w-[30%] h-[50%] bg-white rounded-2xl shadow-md p-8 flex flex-col gap-6 relative items-center">
                                    <div class="border-2 border-mainColor rounded-full w-fit">
                                        <i class="fa-solid fa-question fa-2xl p-8 py-10"
                                        style="color: #1A8889;"></i>
                                    </div>
                                    
                                    <p class="text-2xl text-mainColor font-TripBold text-center">Apakah Anda Yakin
                                        Ingin Menghapus {{ $item->supplier }}?</p>
                                        
                                        <div class="flex gap-4">
                                            <form action="{{ route('delete-supplier',['id'=> $item->supplier_id]) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <button onclick="showPopUpDelete({{ $index }})"
                                                class="bg-mediumRed text-white text-2xl p-1 px-5 rounded-lg">Tidak</button>
                                                <button type="submit"
                                                class="bg-green-600 text-white text-2xl p-1 px-10 rounded-lg">Ya</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Pop up konfirmasi hapus end --}}
                                
                                {{-- MODAL EDIT SUPPLIER START --}}
                                <div class="top-0 left-0 hidden flex flex-col justify-center items-center absolute z-10 backdrop-blur-sm backdrop-brightness-75 rounded-xl w-full h-screen"
                                id="popupEdit{{ $index }}">
                                <div class="w-fit flex flex-col justify-center">
                                    <div class="bg-mainColor text-white font-semibold px-10 py-4 rounded-t-xl flex justify-between">
                                        Edit Supplier
                                        <button onclick="showPopUpEdit({{ $index }})">
                                            <i class="fa-solid fa-xmark fa-xl" style="color: white"></i>
                                        </button>
                                    </div>
                                    <div class="bg-white p-7 pt-4 rounded-b-xl">
                                        <form action="{{ route('edit-supplier',['id'=> $item->supplier_id]) }}" method="post">
                                            @csrf
                                            @method('put')
                                            <div class="flex gap-6 p-4">
                                                <table>
                                                    <tr>
                                                        <td>
                                                            <label for="namaSupplier">Nama Supplier</label>
                                                        </td>
                                                        <td class="ps-5">
                                                            <input type="text" class="p-2 px-4 rounded-xl shadow border @error('nama_supplier') is-invalid @enderror text-slate-400" required value="{{ $item->supplier }}" name="nama_supplier" readonly>
                                                            @error('nama_supplier')
                                                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-5">
                                                            <label for="noTelpSupplier">No Telp Supplier</label>
                                                        </td>
                                                        <td class="ps-5">
                                                            <input type="number" class="p-2 px-4 rounded-xl shadow border @error('no_telp') is-invalid @enderror" required value="{{ $item->supplier_phone }}" name="no_telp">
                                                            @error('no_telp')
                                                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td class="py-5">
                                                            <label for="alamatSupplier">Alamat Supplier</label>
                                                        </td>
                                                        <td class="ps-5">
                                                            <input type="text" class="p-2 px-4 rounded-xl shadow border @error('alamat') is-invalid @enderror" required value="{{ $item->supplier_address }}" name="alamat">
                                                            @error('alamat')
                                                                <div class="text-xs text-mediumRed">{{ $message }}</div>
                                                            @enderror
                                                        </td>
                                                    </tr>
                                                </table>
                                            </div>
                                            <div class="flex justify-end">
                                                <button type="submit"
                                                class="p-2 px-6 me-4 bg-secondaryColor text-white font-semibold rounded-lg">Edit</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            {{-- MODAL EDIT SUPPLIER END --}}
                        </td>
                    </tr>
                    @php
                        $index++;
                    @endphp
                    @endforeach
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
        const showPopUpDelete = (index) => {
            const popup = document.getElementById('popupHapus'+index);

            if (popup.classList.contains('hidden')) {
                popup.classList.remove('hidden')
            } else {
                popup.classList.add('hidden')
            }
        }

        const showPopUpEdit = (index) => {
            const popup = document.getElementById('popupEdit'+index);

            if (popup.classList.contains('hidden')) {
                popup.classList.remove('hidden')
            } else {
                popup.classList.add('hidden')
            }
        }

        const showTambahData = () => {
            const tambahData = document.getElementById('tambahDataSupplier');

            if (tambahData.classList.contains('hidden')) {
                tambahData.classList.remove('hidden')
            } else {
                tambahData.classList.add('hidden')
            }
        }
    </script>
</body>

</html>