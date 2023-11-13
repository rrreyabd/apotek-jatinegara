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
            <div class="md:flex justify-between">
                <p class="text-3xl font-bold mb-2">List Kasir</p>

                <a href="/owner/tambah-kasir" class="px-6 py-2.5 rounded-lg bg-mainColor text-white font-semibold">
                    <i class="fa-solid fa-plus pe-2"></i>
                    Tambah Kasir
                </a>
            </div>

            <div class="bg-white rounded-lg p-4 shadow-md overflow-x-auto">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>Gender</th>
                            <th>No. Handphone</th>
                            <th>Alamat</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for ($i = 0; $i < 6; $i++) <tr>
                            <td>{{$i + 1}}</td>
                            <td>
                                <span class="font-bold">Agus</span>
                            </td>
                            <td>aguslapar@buk.com</td>
                            <td>Perempuan</td>
                            <td>
                                081234567890
                            </td>
                            <td>
                                Jl. Sudirman no.200 Medan Selayang
                            </td>
                            <td>
                                <a href="/owner/edit-kasir" class="p-2 bg-secondaryColor rounded mx-2"><i
                                        class="fa-regular fa-pen-to-square" style="color: white;"></i></a>
                                <button onclick="showPopUpDelete()" class="p-2 bg-mediumRed rounded mx-2"><i
                                        class="fa-regular fa-trash-can" style="color: white;"></i></button>

                                {{-- Pop up konfirmasi hapus start --}}
                                <div class="absolute w-screen h-screen backdrop-blur-md top-0 left-0 flex justify-center items-center backdrop-brightness-75 hidden"
                                    id="popup">
                                    <div
                                        class="w-[30%] h-[50%] bg-white rounded-2xl shadow-md p-8 flex flex-col gap-6 relative items-center">
                                        <div class="border-2 border-mainColor rounded-full w-fit">
                                            <i class="fa-solid fa-question fa-2xl p-8 py-10"
                                                style="color: #1A8889;"></i>
                                        </div>

                                        <p class="text-2xl text-mainColor font-TripBold text-center">Apakah Anda Yakin
                                            Ingin Menghapus soeharto?</p>

                                        <div class="flex gap-4">
                                            <button onclick="showPopUpDelete()"
                                                class="bg-mediumRed text-white text-2xl p-1 px-5 rounded-lg">Tidak</button>
                                            <button type="submit"
                                                class="bg-green-600 text-white text-2xl p-1 px-10 rounded-lg">Ya</button>
                                        </div>
                                    </div>
                                </div>
                                {{-- Pop up konfirmasi hapus end --}}
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
        const showPopUpDelete = () => {
            const popup = document.getElementById('popup');

            if (popup.classList.contains('hidden')) {
                popup.classList.remove('hidden')
            } else {
                popup.classList.add('hidden')
            }
        }
    </script>
</body>

</html>