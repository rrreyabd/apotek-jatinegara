<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Detail Pesanan</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>
</head>
<body class="font-Inter bg-semiWhite">
    @include('user.components.secondNavbar')

    <div class="flex justify-center">
        <div class="w-[80vw] py-10 flex justify-between">
            <div class="w-[60%] rounded-t-xl overflow-hidden gap-6 flex-col flex bg-white">
                <div class="bg-secondaryColor px-8 py-4 flex justify-between font-semibold items-center">
                    <p>Detail Pesanan</p>
                    <p>2 Item</p>
                </div>

                <div class="text-sm px-8">
                    <p>Tanggal Pesanan : <span class="font-semibold">21 Desember 2023</span> </p>
                    <p>Batas Pengambilan : <span class="font-semibold">25 Desember 2023</span> </p>
                </div>

                @for ($i = 0; $i < 3; $i++)
                <div class="px-8 flex justify-between">
                    <div class="flex gap-2">
                        <img src="{{ asset('img/obat1.jpg/') }}" width="100" alt="">

                        <div class="flex flex-col justify-between text-sm">
                            <div class="w-[25vw]">
                                <p class="font-bold">PARACETAMOL 500 MG STRIP 10 KAPLET</p>
                                <p>Kategori : Demam</p>
                            </div>

                            <p class="bg-red-600 text-white w-fit px-2 font-semibold text-xs py-1 rounded-md">Perlu Resep</p>

                            <p>EXP :  <span class="font-semibold">25 Desember 2090</span></p>
                        </div>
                    </div>

                    <div class="text-end w-[10vw]">
                        <p>12 x Rp. 5.000.000</p>
                        <p>Total : Rp.60.000</p>
                    </div>
                </div>
                @endfor

                <hr class="border-1 border border-black opacity-25">

                <div class="flex justify-between px-8">
                    <p>Total Pesanan</p>
                    <p class="font-bold">Rp. 156.000</p>
                </div>

                <div class="px-8 text-red-600 text-sm">
                    <p>* Harap untuk membaca S&K sebelum melakukan pemesanan</p>
                    <p>* Apotek kami tidak menerima pengajuan refund untuk pesanan yang telah melawati masa batas pengambilan</p>
                </div>

            </div>

            <form action="" method=""
            class="bg-mainColor px-12 pt-10  pb-14 w-[36%] rounded-xl shadow-md flex flex-col gap-4 h-fit">
                <p class="font-bold text-white text-2xl">Form Pesanan</p>
                <input type="text" placeholder="Nama Pengambil Pesanan" class="h-12 px-4 rounded-2xl shadow-md">
                <input type="number" placeholder="No. HP" class="h-12 px-4 rounded-2xl shadow-md">

                <div class="flex flex-col gap-2">
                    <label for="resepDokter" class="h-12 px-4 rounded-2xl shadow-md shadow-mediumGrey h-10 px-3 text-sm bg-white cursor-pointer flex gap-2 justify-start items-center">
                        <input type="file" name="" id="resepDokter" onchange="updateLabel()" class="hidden">
                        
                        <div class="w-7 h-7 rounded-full bg-mainColor text-white flex items-center justify-center">
                            <i class="fa-solid fa-download"></i>
                        </div>
                        
                        <p id="fileName" class="opacity-50">Upload Resep Dokter</p>
                    </label>
                    <p class="text-white text-xs px-4">*sertakan resep dokter apabila diperlukan</p>
                </div>

                <input type="text" placeholder="Catatan Opsional" class="h-12 px-4 rounded-2xl shadow-md">

                <button type="submit" class="bg-secondaryColor px-4 h-12 text-xl font-bold text-white rounded-2xl">Bayar Sekarang</button>
            </form>
        </div>
    </div>

    @include('user.components.footer')

    <script>
        const updateLabel = () => {
          const input = document.getElementById('resepDokter');
          const fileName = input.files[0].name;
          const label = document.getElementById('fileName');
          label.textContent = fileName;
        }
    </script>
</body>
</html>