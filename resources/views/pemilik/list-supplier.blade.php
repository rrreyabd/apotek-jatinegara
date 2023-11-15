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
{{-- 
    <style>
        *{
            border: red 2px solid;
        }
    </style> --}}
</head>

<body class="font-Inter relative">
    @include('pemilik.components.sidebar')
    <main class="p-10 font-Inter bg-plat min-h-[100vh] h-full" id="mainContent">
        @include('pemilik.components.navbar')

        <div class="flex flex-col gap-8 mt-10">
            <div class="md:flex justify-between mb-5">
                <p class="text-3xl font-bold mb-2">List Supplier</p>

                <button onclick="showTambahData()" class="px-6 py-2.5 rounded-lg bg-mainColor text-white font-semibold">
                    <i class="fa-solid fa-plus pe-2"></i>
                    Tambah Supplier
                </button>
            </div>

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
                        <form action="" method="post">
                            <div class="flex gap-6 p-4">
                                <table>
                                    <tr>
                                        <td><label for="namaSupplier">Nama Supplier</label></td>
                                        <td class="ps-5"><input type="text" class="p-2 px-4 rounded-xl shadow border"></td>
                                    </tr>
                                    <tr>
                                        <td class="py-5"><label for="kodeSupplier">Kode Supplier</label></td>
                                        <td class="ps-5"><input type="text" class="p-2 px-4 rounded-xl shadow border"></td>
                                    </tr>
                                    <tr>
                                        <td class="py-5"><label for="noTelpSupplier">No Telp Supplier</label></td>
                                        <td class="ps-5"><input type="text" class="p-2 px-4 rounded-xl shadow border"></td>
                                    </tr>
                                    <tr>
                                        <td class="py-5"><label for="alamatSupplier">Alamat Supplier</label></td>
                                        <td class="ps-5"><input type="text" class="p-2 px-4 rounded-xl shadow border"></td>
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
        </div>

        <div class="bg-white rounded-lg p-4 shadow-md overflow-x-auto">
            <table id="myTable" class="table table-striped">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Supplier</th>
                        <th>Alamat Supplier</th>
                        <th>Nomor Telepon</th>
                    </tr>
                </thead>
                <tbody>
                    @for ($i = 0; $i < 4; $i++) <tr>
                        <td>{{$i + 1}}</td>
                        <td>
                            <span class="font-bold">Agus</span>
                        </td>
                        <td>Jalan Mojokerto No 1 , Kecamatan pohon kelurahan ranting, kota medan</td>
                        <td>+06112234567</td>
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