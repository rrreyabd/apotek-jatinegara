<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Pemilik Apotek | Pesanan Pending</title>
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
            @endif
            @if (session('error_status'))
                <div class="absolute top-4 left-[42.5vw] bg-red-600 shadow-md w-[15vw] h-14 z-20 gap-2 items-center px-4 animate-notif opacity-0 justify-center rounded-md flex unselectable">
                    <i class="text-white fa-solid fa-triangle-exclamation"></i>
                    <p class="text-lg text-white font-semibold"> {{ session('error_status') }} </p>
                </div>
            @endif


        <div class="flex flex-col gap-8 mt-10">
            <p class="text-3xl font-bold">Pesanan Pending</p>

            @error('buktiRefund')
            <div class="text-md font-bold text-red-500 mt-1 ms-3 mb-0 text-left">
                {{ $message }}
            </div>
            @enderror

            <div class="bg-white rounded-lg p-4 shadow-md overflow-x-auto">
                <table id="myTable" class="table table-striped">
                    <thead>
                        <tr>
                            <th>No.</th>
                            <th>Nomor Invoice</th>
                            <th>Nama Pengambil</th>
                            <th>Metode Pembayaran</th>
                            <th>Infomasi Pembayaran</th>
                            <th>Keterangan</th>
                            <th>Detail Pesanan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i=1; @endphp
                        @php $index = 1; @endphp
                        @foreach ($pendingOrders as $order) <tr>
                            <td>{{$i}}</td>
                            <td>
                                <span class="font-bold">{{ $order->invoice_code }}</span>
                            </td>
                            <td>{{ $order->recipient_name }}</td>
                            <td>{{ $order->recipient_bank }}</td>
                            <td>
                                <button onclick="showPaymentSS({{ $index }})" target="_blank"
                                    class="underline">{{ $order->recipient_payment }}</button>
                                <div class="absolute w-full h-full top-0 left-0 flex justify-center pt-28 items-start backdrop-brightness-[.25] z-10 hidden"
                                    id="ModalBuktiPembayaran{{ $index }}">
                                    <div class="bg-white rounded-xl shadow-md">
                                        <div
                                            class="bg-mainColor text-white font-semibold px-10 py-4 rounded-t-xl flex justify-between">
                                            {{ $order->recipient_payment }}
                                            <button onclick="showPaymentSS({{ $index }})">
                                                <i class="fa-solid fa-xmark fa-xl" style="color: white"></i>
                                            </button>
                                        </div>
                                        <img src="{{ asset('/storage/bukti-pembayaran/'.$order->recipient_payment)}}" alt=""
                                            class="h-[60vh] w-fit relative p-4">
                                    </div>
                                </div>
                            </td>
                            <td>
                                <p class="font-bold opacity-60">{{ date('d M Y',strtotime($order->order_date)) }}</p>
                            </td>
                            <td>
                                <button
                                    class="border-2 border-secondaryColor rounded-md hover:bg-transparent hover:text-secondaryColor font-bold px-4 py-1 bg-secondaryColor text-white duration-300 transition-colors ease-in-out"
                                    type="button" onclick="toggleDetail({{ $index }})">Lihat</button>

                                {{-- MODAL DETAIL PESANAN PENDING START --}}
                                <div class="absolute w-full h-full top-0 left-0 flex justify-center items-center backdrop-brightness-75 z-10 hidden"
                                    id="detailModal{{ $index }}">
                                    <div
                                        class="w-[70%] h-fit max-h-full bg-white rounded-md shadow-md p-8 flex flex-col gap-6 overflow-auto">
                                        <div class="">
                                            <button onclick="toggleDetail({{ $index }})" type="button"
                                                class="bg-mainColor py-1 px-4 text-white font-semibold rounded-md">
                                                <i class="fa-solid fa-arrow-left"></i>
                                                Kembali
                                            </button>
                                        </div>

                                        <div class="px-8 py-2 w-[100%] flex justify-between">
                                            <div class="overflow-y-auto h-72 w-[70%]">
                                                <table class="w-full h-full overflow-scroll">
                                                    <tr
                                                        class="border-2 border-b-mainColor border-transparent text-mainColor font-bold w-[100%]">
                                                        <td class="w-[10%] pb-2 text-center">No</td>
                                                        <td class="w-[50%] pb-2">Nama</td>
                                                        <td class="w-[20%] pb-2 text-center">Jumlah</td>
                                                        <td class="w-[20%] pb-2">Resep Dokter</td>
                                                    </tr>
                                                    @php $j  = 1; @endphp
                                                    @foreach ($order->sellingInvoiceDetail as $detail) <tr>
                                                        <td class="py-2 text-center">{{$j}}</td>
                                                        <td class="py-2">{{ $detail->product_name }}</td>
                                                        <td class="py-2 text-center">{{ $detail->quantity }}</td>
                                                        <td class="py-2">{{ $detail->product_type }}</td>
                                                        </tr>
                                                        @php $j++ @endphp
                                                    @endforeach
                                                </table>
                                            </div>

                                            <div class="w-[25%]">
                                                <div class="">
                                                    <table class="w-full">
                                                        <tr
                                                            class="border-2 border-b-mainColor border-transparent text-mainColor font-bold w-[100%]">
                                                            <td class="w-[10%] pb-2 text-center">File Resep Dokter</td>
                                                        </tr>
                                                        <tr>
                                                            <td class="py-2 flex gap-2 items-center">
                                                                <i class="fa-solid fa-image"></i>
                                                                <a href="/owner/resep_dokter/{{ $order->recipient_file }}"
                                                                    target="_blank">{{ $order->recipient_file }}</a>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="px-8 w-[100%]">
                                            <p
                                                class="text-mainColor font-bold py-2 border-2 border-b-mainColor border-transparent">
                                                Catatan</p>
                                            <p class="py-4">{{ $order->recipient_request }}
                                            </p>
                                        </div>

                                        {{-- JIKA STATUS REFUND --}}
                                        <form action="{{ route('owner-refund', $order->selling_invoice_id) }}" method="post" enctype="multipart/form-data">
                                        <div class="px-8 w-[100%]">
                                            <p
                                                class="text-mainColor font-bold py-2 border-2 border-b-mainColor border-transparent">
                                                Upload Bukti Refund</p>

                                            <div class="md:flex w-1/2 items-center">
                                                <div class="me-3">
                                                    <input type="file" id="buktiRefund{{ $index }}" name="buktiRefund" class="invisible" accept=".pdf, .png, .jpg, .jpeg" onchange="updateLabel({{ $index }});showFile(this, {{ $index }});" required>
                                                    <button id="file" onclick="document.getElementById('buktiRefund{{ $index }}').click(); return false;" class="p-2 w-full border rounded-xl shadow">
                                                        <div class="flex items-center gap-2">
                                                            <i class="fa-solid fa-arrow-up-from-bracket p-2 px-2.5 rounded-full bg-mainColor w-fit ms-2" style="color: white;"></i>
                                                            <p id="fileName{{ $index }}" class="text-mediumGrey">Upload gambar</p>
                                                        </div>
                                                    </button>
                                                    <p class="text-xs text-mediumRed mt-2">*Maks 5mb</p>
                                                </div>
                                                <div class="w-full h-full m-2 border-2 flex justify-center">
                                                    <img src="" alt="" id="uploadedFile{{ $index }}" class="max-w-full max-h-full">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex justify-end w-full">

                                                @csrf
                                                <button type="submit" class="bg-green-600 text-white font-bold py-2 px-4 rounded-md shadow-md">
                                                    Tandai Selesai
                                                </button>
                                        </div>
                                    </form>
                                    </div>
                                </div>
                                {{-- MODAL DETAIL PESANAN PENDING END --}}
                            </td>
                            </tr>
                            @php $i++ @endphp
                            @php $index++  @endphp
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
        const toggleDetail = (index) => {
            const modal = document.getElementById('detailModal'+index);

            if (modal.classList.contains('hidden')) {
                modal.classList.remove('hidden')
                document.body.classList.add('h-fit')
            } else {
                modal.classList.add('hidden')
                document.body.classList.remove('h-fit')
            }
        }

        const showPaymentSS = (index) => {
            const modalBukti = document.getElementById('ModalBuktiPembayaran'+index);

            if (modalBukti.classList.contains('hidden')) {
                modalBukti.classList.remove('hidden')
                document.body.classList.add('h-fit')
            } else {
                modalBukti.classList.add('hidden')
                document.body.classList.remove('h-fit')
            }
        }

        const updateLabel = (index) => {
        const input = document.getElementById('buktiRefund'+index);
        const fileName = input.files[0].name;
        const label = document.getElementById('fileName'+index);
        label.textContent = fileName;
        }

        function showFile(input, index) {
        const getFile = document.getElementById('uploadedFile'+index);
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = (e) => {
                getFile.src = e.target.result;
            };
            reader.readAsDataURL(input.files[0]);
            }
        }
    </script>
</body>

</html>