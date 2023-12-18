<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilik Apotek | User</title>
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

        @if (session('add_status'))
            <div class="absolute top-4 left-[42.5vw] bg-mainColor shadow-md w-[25vw] h-14 z-20 gap-2 items-center px-4 animate-notif opacity-0 justify-center rounded-md flex unselectable">
                <i class="text-white fa-solid fa-circle-check"></i>
                <p class="text-lg text-white font-semibold"> {{ session('add_status') }} </p>
            </div>
        @elseif (session('error_status'))
            <div class="absolute top-4 left-[42.5vw] bg-red-500 shadow-md w-[25vw] h-14 z-20 gap-2 items-center px-4 animate-notif opacity-0 justify-center rounded-md flex unselectable">
                <p class="text-lg text-white font-semibold"> {{ session('error_status') }} </p>
            </div>
        @endif

        <div class="flex flex-col gap-8 mt-10">
            <div class="md:flex justify-between">
                <p class="text-3xl font-bold mb-2">List Pengguna</p>
            </div>

            <div class="bg-white rounded-lg p-4 shadow-md overflow-x-auto">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama User</th>
                            <th>Email</th>
                            <th>No. Telepon</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $i = 1;
                            $index = 1;
                        @endphp
                        @foreach ($user as $item)
                        <tr>
                            <td>{{$i++}}</td>
                            <td>
                                <span class="font-bold">{{ $item->user->username }}</span>
                            </td>
                            <td>{{ $item->user->email }}</td>
                            <td>
                                {{ $item->customer_phone }}
                            </td>
                            <td>
                                <button onclick="showPopUpDelete({{ $index }})" class="p-2 bg-mediumRed rounded"><i
                                        class="fa-regular fa-trash-can" style="color: white;"></i></button>

                                {{-- Pop up konfirmasi hapus start --}}
                                <div class="fixed w-screen h-screen backdrop-blur-md top-0 left-0 flex justify-center items-center backdrop-brightness-75 hidden"
                                    id="popup{{ $index }}">
                                    <div
                                        class="w-[30%] h-[50%] bg-white rounded-2xl shadow-md p-8 flex flex-col gap-6 relative items-center">
                                        <div class="border-2 border-mainColor rounded-full w-fit">
                                            <i class="fa-solid fa-question fa-2xl p-8 py-10"
                                                style="color: #1A8889;"></i>
                                        </div>

                                        <p class="text-2xl text-mainColor font-TripBold text-center">Apakah Anda Yakin
                                            Ingin Menghapus {{ $item->user->username }}?</p>

                                        <div class="flex gap-4">
                                            <form action="{{ route('delete-user',['id'=> $item->customer_id]) }}" method="post">
                                                @csrf
                                                @method('put')
                                                <button type="button" onclick="showPopUpDelete({{ $index }})"
                                                class="bg-mediumRed text-white text-2xl p-1 px-5 rounded-lg">Tidak</button>
                                                <button type="submit"
                                                class="bg-green-600 text-white text-2xl p-1 px-10 rounded-lg">Ya</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                {{-- Pop up konfirmasi hapus end --}}
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
            const popup = document.getElementById('popup'+index);

            if (popup.classList.contains('hidden')) {
                popup.classList.remove('hidden')
            } else {
                popup.classList.add('hidden')
            }
        }
    </script>
</body>

</html>