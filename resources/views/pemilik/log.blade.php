<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Owner | Log</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    {{-- DATATABLES --}}
    <link href="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/style.min.css" rel="stylesheet" />

</head>
<body class="font-Inter relative">
    @include("pemilik.components.sidebar")
    <main class="p-10 font-Inter bg-plat min-h-[100vh] h-full" id="mainContent">
        {{-- @include("pemilik.components.navbar") --}}

        <div class="flex flex-col gap-8 mt-10">
            <p class="text-3xl font-bold">Log Apotek</p>

            <div class="bg-white rounded-lg p-4 shadow-md">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Pelaku</th>
                            <th>Tanggal</th>
                            <th>Aktivitas</th>
                            <th>Nilai lama</th>
                            <th>Nilai baru</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1;  @endphp
                        @php $index = 1;  @endphp
                        @for ($j = 0; $j < 10; $j++)
                        <tr>
                            <td>{{$i}}</td>
                            <td>
                                <span class="font-bold">Kasir</span>
                            </td>
                            <td> 18 November 2023</td>
                            <td> 
                                <span class="font-bold">Insert</span>
                            </td>
                            <td> Nilai lama </td>
                            <td> Nilai baru </td>
                        </tr>
                        @php  $i++   @endphp
                        @php  $index++   @endphp
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
    </main>

    {{-- DATATABLES SCRIPT --}}
    <script src="https://cdn.jsdelivr.net/npm/simple-datatables@7.1.2/dist/umd/simple-datatables.min.js" crossorigin="anonymous"></script>
    <script src="{{ asset('js/datatables.js') }}"></script>

    <script>
        const toggleDetail = (index) => {
            const modal = document.getElementById('detailModal' + index);

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden');
                document.body.classList.add('h-[100vh]');
            } else {
                modal.classList.add('hidden');
                document.body.classList.remove('h-[100vh]');
            }
        };
    </script>
</body>
</html>