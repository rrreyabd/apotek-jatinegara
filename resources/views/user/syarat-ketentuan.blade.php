<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Syarat dan Ketentuan</title>
    @livewireStyles
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

    <style>
        td {
            height: 30px;
        }
    </style>

</head>
<body class="font-Inter w-full">
    @include('user.components.navbar')

    {{-- NAV MENU --}}
    <div class="w-full h-12 flex">
        <a href="s&k" class="w-1/2 h-full text-center flex justify-center items-center text-lg hover:brightness-90 duration-100 ease-in-out bg-mainColor text-white font-bold">Syarat dan Ketentuan</a>
        <a href="cara-belanja" class="w-1/2 h-full text-center flex justify-center items-center text-lg hover:brightness-75 brightness-90 duration-100 ease-in-out bg-white text-black font-bold">Cara Belanja</a>
    </div>
    {{-- NAV MENU --}}

    {{-- MAIN --}}
    <main class="px-56 py-4 h-fit flex flex-col gap-16">
        <div class="flex flex-col gap-4">
            <b>Selamat datang di {{ $apotek->apotic_name }}!</b>
            <p>Informasi Apotek :</p>
            
            <table class="w-3/4">
                <tr>
                    <td class="w-1/3">Nama Apotek</td>
                    <td class="w-2/3">: {{ $apotek->apotic_name }} </td>
                </tr>
                <tr>
                    <td>Website</td>
                    <td>: {{ $apotek->apotic_web_name }}</td>
                </tr>
                <tr>
                    <td>Nomor SIA</td>
                    <td>: {{ $apotek->SIA_number }}</td>
                </tr>
                <tr>
                    <td>Penanggung Jawab Apotek</td>
                    <td>: {{ $apotek->apotic_owner }}</td>
                </tr>
                <tr>
                    <td>Nomor SIPA</td>
                    <td>: {{ $apotek->SIPA_number }}</td>
                </tr>
                <tr>
                    <td>Alamat Apotek</td>
                    <td>: {{ $apotek->apotic_address }}</td>
                </tr>
                <tr>
                    <td class="flex">Jam Operasional</td>
                    <td>Senin : {{ $apotek->monday_schedule }} <br>
                        Selasa : {{ $apotek->tuesday_schedule }} <br>
                        Rabu : {{ $apotek->wednesday_schedule }} <br>
                        Kamis : {{ $apotek->thursday_schedule }} <br>
                        Jumat : {{ $apotek->friday_schedule }} <br>
                        Sabtu : {{ $apotek->saturday_schedule }} <br>
                        Minggu : {{ $apotek->sunday_schedule }}</td>
                </tr>
            </table>
        </div>

        <div class="flex flex-col gap-4">
            <p>
                Syarat dan ketentuan ini mengatur tata cara penggunaan fitur-fitur dan/atau layanan-layanan mengenai penggunaan dan/atau pemanfaatan Situs {{ $apotek->apotic_name }}.
            </p>
            <p>
                Dengan mendaftar, menggunakan, dan/atau mengakses Situs {{ $apotek->apotic_name }} ini maka Anda setuju dengan syarat dan ketentuan  yang ditetapkan {{ $apotek->apotic_name }}. Jika Anda tidak setuju dengan syarat dan ketentuan berikut ini, maka Anda dapat berhenti mengakses layanan {{ $apotek->apotic_name }}.
            </p>
            <p>
                {{ $apotek->apotic_name }} berhak sewaktu-waktu mengubah, menghapus dan menerapkan ketentuan baru dalam Syarat dan Ketentuan ini. Dengan mendaftar, menggunakan, dan/atau melakukan akses ke Situs {{ $apotek->apotic_name }}, maka Anda secara mandiri dan sukarela telah membaca, mengerti, memahami, dan menyetujui seluruh isi dalam Syarat dan Ketentuan ini (termasuk Kebijakan Privasi).
            </p>
        </div>

        {{-- A --}}
        <div class="flex flex-col gap-1">
            <b>A. DEFINISI</b>
            <div class="flex gap-3">
                <p>1</p>
                <p>
                    {{ $apotek->apotic_name }} adalah situs {{ $apotek->apotic_web_name }} yang dimiliki, dikelola dan ditawarkan oleh {{ $apotek->apotic_name }}, yang mana situs {{ $apotek->apotic_web_name }} tersebut dapat diakses pada perangkat handphone & PC Anda. 
                </p>
            </div>
            <div class="flex gap-3">
                <p>2</p>
                <p>
                    Syarat dan Ketentuan adalah kesepakatan antara Anda dan {{ $apotek->apotic_name }} yang mengatur hak dan kewajiban, serta tanggung jawab masing-masing pihak termasuk tata cara penggunaan situs {{ $apotek->apotic_name }}. 
                </p>
            </div>
            <div class="flex gap-3">
                <p>3</p>
                <p>
                    Anda adalah setiap orang atau pihak yang secara mandiri dan sukarela melakukan pendaftaran di Situs {{ $apotek->apotic_name }} 
                </p>
            </div>
            <div class="flex gap-3">
                <p>4</p>
                <p>
                    Rekening Resmi {{ $apotek->apotic_name }} adalah rekening bersama yang disepakati oleh {{ $apotek->apotic_name }} dan Anda untuk proses transaksi jual beli di Apotek Jati Negar
                </p>
            </div>
        </div>
        {{-- A --}}
    
        {{-- B --}}
        <div class="flex flex-col gap-1">
            <b>B. PENGGUNAAN {{ $apotek->apotic_name }}</b>
            <div class="flex gap-3">
                <p>1</p>
                <p>
                    Dengan mengakses, mendaftar, dan/atau menggunakan situs {{ $apotek->apotic_name }}, maka Anda menyatakan bahwa Anda adalah pribadi yang cakap secara hukum dan Anda telah membaca, memahami, dan menyetujui semua Syarat dan Ketentuan penggunaan situs {{ $apotek->apotic_name }}. Pada saat Anda mengakses dan menggunakan {{ $apotek->apotic_name }}, maka Anda setuju untuk mematuhi Syarat dan Ketentuan (termasuk Kebijakan Privasi) yang diberlakukan oleh pihak {{ $apotek->apotic_name }}.
                </p>
            </div>
            <div class="flex gap-3">
                <p>2</p>
                <p>
                    Anda dilarang untuk: <br> 
                    a) menyebarkan bug, spam, virus, worm, logic bom atau mengirimkan atau teknologi sejenis lainnya atau materi-materi berbahaya yang dapat merusak, merugikan dan/atau mengganggu kinerja seluruh akses terhadap {{ $apotek->apotic_name }} <br> 
                    b)mengalihkan akun Anda kepada pihak lain <br>
                    c) memperoleh, mengambil atau mengumpulkan data milik lainnya, secara tanpa hak atau melawan hukum <br>
                    d) menggunakan situs {{ $apotek->apotic_name }} untuk melakukan kegiatan komersial apapun <br> 
                    e) menggunakan {{ $apotek->apotic_name }} termasuk fitur-fitur dan layanan-layanannya untuk hal-hal yang dilarang oleh peraturan perundang-undangan yang berlaku.
                </p>
            </div>
            <div class="flex gap-3">
                <p>3</p>
                <p>
                    Setiap tindakan yang merupakan pelanggaran ketentuan peraturan perundang-undangan termasuk Undang-undang No 11 tahun 2008 tentang Internet dan Transaksi Elektronik (ITE) sebagaimana diubah dari waktu-waktu, yang dilakukan oleh Anda, maka {{ $apotek->apotic_name }} berhak melaporkan pelanggaran kepada pihak yang berwajib. {{ $apotek->apotic_name }} dapat menggunakan jasa pihak ketiga termasuk namun tidak terbatas terkait penyediaan layanan pembayaran. Karena itu segala bentuk kegagalan sistem terkait yang disebabkan hal yang di luar kendali {{ $apotek->apotic_name }} termasuk namun tidak terbatas terkait dengan layanan pembayaran yang disediakan pihak ketiga adalah di luar tanggung jawab {{ $apotek->apotic_name }}. Namun demikian, {{ $apotek->apotic_name }} akan berupaya maksimal untuk membantu menyelesaikan masalah yang mungkin timbul
                </p>
            </div>
        </div>
        {{-- B --}}

        {{-- C --}}
        <div class="flex flex-col gap-1">
            <b>C. PENDAFTARAN DAN PENGAKHIRAN KEANGGOTAAN</b>
            <div class="flex gap-3">
                <p>1</p>
                <p>
                    Anda dapat mendaftar secara langsung melalui menu “Daftar” tanpa dipungut biaya. Setelah melakukan pendaftaran, Anda bertanggung jawab untuk menjaga kerahasiaan akun dan password untuk semua aktivitas yang terjadi dalam akun Anda 
                </p>
            </div>
            <div class="flex gap-3">
                <p>2</p>
                <p>
                    {{ $apotek->apotic_name }} tidak akan meminta password akun Anda untuk alasan apapun, oleh karena itu {{ $apotek->apotic_name }} menghimbau Anda agar tidak memberikan password kepada pihak manapun, baik kepada pihak ketiga maupun kepada pihak yang mengatasnamakan {{ $apotek->apotic_name }}. 
                </p>
            </div>
            <div class="flex gap-3">
                <p>3</p>
                <p>
                    Anda dapat mengakhiri keanggotaan Anda dengan cara menghapus akun pada situs {{ $apotek->apotic_name }}.
                </p>
            </div>
            <div class="flex gap-3">
                <p>4</p>
                <p>
                    {{ $apotek->apotic_name }} berhak untuk menghentikan penggunaan {{ $apotek->apotic_name }} apabila {{ $apotek->apotic_name }} memiliki alasan bahwa Anda telah melanggar Syarat dan Ketentuan ini (termasuk Kebijakan Privasi) atau peraturan perundang-undangan yang berlaku
                </p>
            </div>
        </div>
        {{-- C --}}

        {{-- D --}}
        <div class="flex flex-col gap-1">
            <b>D. TRANSAKSI PEMBELIAN</b>
            <div class="flex gap-3">
                <p>1</p>
                <p>
                    Saat melakukan pembelian produk, Anda selaku pembeli menyetujui bahwa: <br>
                    a. Anda bertanggung jawab untuk membaca, memahami, dan menyetujui informasi/deskripsi keseluruhan produk (termasuk tetapi tidak terbatas pada warna, kualitas, fungsi, dan lainnya) sebelum membeli produk. <br>
                    b. Dengan melakukan pembelian di {{ $apotek->apotic_name }}, Anda setuju melakukan kontrak pembelian produk yang mengikat secara hukum.
                </p>
            </div>
            <div class="flex gap-3">
                <p>2</p>
                <p>
                    Anda memahami bahwa ketersediaan stok produk dapat berubah sewaktu-waktu, sehingga {{ $apotek->apotic_name }} dapat menolak pesanan/order.
                </p>
            </div>
            <div class="flex gap-3">
                <p>3</p>
                <p>
                    Anda memahami sepenuhnya dan menyetujui bahwa pada dasarnya transaksi yang dilakukan adalah antara Anda sebagai pembeli dan {{ $apotek->apotic_name }} sebagai penjual
                </p>
            </div>
            <div class="flex gap-3">
                <p>4</p>
                <p>
                    Anda memahami sepenuhnya dan menyetujui bahwa segala transaksi yang dilakukan antara Anda dan {{ $apotek->apotic_name }} selain melalui rekening resmi {{ $apotek->apotic_name }} dan/atau tanpa sepengetahuan {{ $apotek->apotic_name }} (melalui fasilitas/jaringan pribadi, pengiriman pesan, pengaturan transaksi khusus di luar Situs {{ $apotek->apotic_name }} atau bentuk lainnya) merupakan tanggung jawab pribadi dari Anda.
                </p>
            </div>
            <div class="flex gap-3">
                <p>5</p>
                <p>
                    Anda memahami dan menyetujui bahwa masalah keterlambatan proses pembayaran dan biaya tambahan yang disebabkan oleh perbedaan bank yang Anda gunakan dengan bank rekening resmi {{ $apotek->apotic_name }} adalah tanggung jawab Anda sepenuhnya.
                </p>
            </div>
            <div class="flex gap-3">
                <p>6</p>
                <p>
                    Pengembalian dana dari {{ $apotek->apotic_name }} kepada Anda akan ditransfer ke rekening Anda atau melalui fitur e-wallet account (jika tersedia) Anda dimulai dari jam 19.00 sampai jam 21.00 di hari Senin - Sabtu dan hanya dapat dilakukan jika dalam keadaan-keadaan tertentu seperti berikut ini: <br>
                    a) Kelebihan pembayaran dari Anda atas nilai transaksi yang terdiri dari harga produk beserta biaya-biaya lainnya (jika ada), yang oleh Anda secara tertulis diminta untuk dikembalikan secara transfer ke rekening Anda yang sah atau dipindahkan ke e-wallet account (jika ada) Anda. <br>
                    b) Pengembalian produk disebabkan oleh permasalahan produk tidak sesuai dengan spesifikasi atau permasalahan lainnya yang diatur oleh peraturan perundang-undangan yang berlaku di Indonesia. <br>
                    c) Stok obat yang tidak tersedia setelah pembayaran dilakukan.
                </p>
            </div>
            <div class="flex gap-3">
                <p>7</p>
                <p>
                    Transaksi yang sudah direspon oleh {{ $apotek->apotic_name }} tidak dapat dibatalkan, kecuali dalam kondisi adanya pembatalan dari pihak {{ $apotek->apotic_name }}
                </p>
            </div>
            <div class="flex gap-3">
                <p>8</p>
                <p>
                    Apabila anda tidak mengambil obat dalam waktu 3 x 24 jam setelah pembayaran dilakukan, dan tidak ada konfirmasi keterlambatan pengambilan kepada pihak apotek. maka pihak apotek dapat membatalkan pesanan dan pembayaran yang dilakukan tidak dapat dikembalikan.
                </p>
            </div>
            <div class="flex gap-3">
                <p>9</p>
                <p>
                    {{ $apotek->apotic_name }} berhak membatalkan pesanan apabila ditemukan adanya indikasi kecurangan/pelanggaran yang merugikan {{ $apotek->apotic_name }}
                </p>
            </div>
        </div>
        {{-- D --}}

        {{-- E --}}
        <div class="flex flex-col gap-1">
            <b>E. OPERASIONAL {{ $apotek->apotic_name }}</b>
            <div class="flex gap-3">
                <p>1</p>
                <p>
                    Untuk pembelian produk yang menggunakan resep, Anda akan menerima balasan dari {{ $apotek->apotic_name }} tentang diterima atau tidaknya pesanan produk yang menggunakan resep tersebut dalam batas waktu 1 x 24 jam. Apabila dalam waktu 1 x 24 jam tidak ada konfirmasi atau balasan dari pihak Apotek, Anda dapat menghubungi customer service {{ $apotek->apotic_name }} untuk bantuan lebih lanjut 
                </p>
            </div>
            <div class="flex gap-3">
                <p>2</p>
                <p>
                    Apabila {{ $apotek->apotic_name }} menyetujui untuk menerima pesanan Anda, maka {{ $apotek->apotic_name }} akan menyimpan/book obat sesuai pesanan anda selama 3 x 24 jam
                </p>
            </div>
            <div class="flex gap-3">
                <p>3</p>
                <p>
                    Pesanan hanya dilayani di jam operasional {{ $apotek->apotic_name }} yaitu: <br>
                    Senin : {{ $apotek->monday_schedule }} <br>
                    Selasa : {{ $apotek->tuesday_schedule }} <br>
                    Rabu : {{ $apotek->wednesday_schedule }} <br>
                    Kamis : {{ $apotek->thursday_schedule }} <br>
                    Jumat : {{ $apotek->friday_schedule }} <br>
                    Sabtu : {{ $apotek->saturday_schedule }} <br>
                    Minggu : {{ $apotek->sunday_schedule }}
                </p>
            </div>
        </div>
        {{-- E --}}
        
        {{-- F --}}
        <div class="flex flex-col gap-1">
            <b>F. HARGA</b>
            <div class="flex gap-3">
                <p>1</p>
                <p>
                    Harga produk yang dijual oleh {{ $apotek->apotic_name }} dan ditayangkan di situs {{ $apotek->apotic_web_name }} adalah harga yang ditetapkan oleh {{ $apotek->apotic_name }}. Harga produk tersebut tidak mengikat, dan dapat berubah sewaktu-waktu, sesuai kebijakan Apotek
                </p>
            </div>
            <div class="flex gap-3">
                <p>2</p>
                <p>
                    Apabila terdapat informasi dari Apotek yang menyatakan bahwa harga produk yang dijualnya di situs {{ $apotek->apotic_web_name }} belum harga yang terkini, maka Apotek berhak membatalkan transaksi atau menagih kekurangan maupun kelebihan biaya yang timbul atas perbedaan harga tersebut dengan disertai dokumen pendukung yang sah
                </p>
            </div>
            <div class="flex gap-3">
                <p>3</p>
                <p>
                    Dengan melakukan pemesanan melalui {{ $apotek->apotic_name }}, Anda menyetujui untuk membayar total biaya yang harus dibayarkan sebagaimana tertera dalam halaman pembayaran, yang terdiri dari harga produk, dan biaya-biaya lain yang mungkin timbul dan diuraikan secara tegas dalam halaman pembayaran. Anda setuju untuk melakukan pembayaran melalui metode pembayaran yang telah disediakan untuk Anda
                </p>
            </div>
            <div class="flex gap-3">
                <p>4</p>
                <p>
                    Transaksi di {{ $apotek->apotic_name }} hanya bisa dalam mata uang Rupiah
                </p>
            </div>
        </div>
        {{-- F --}}
        
        {{-- G --}}
        <div class="flex flex-col gap-1">
            <b>G. FITUR DAN LAYANAN</b>
            <div class="flex gap-3">
                <p>1</p>
                <p>
                    Fitur atau layanan yang dapat digunakan oleh Anda di Situs {{ $apotek->apotic_name }} adalah sebagai berikut: <br>
                    a) Melalui Situs {{ $apotek->apotic_name }}, Anda dapat melakukan pembelian produk-produk kesehatan melalui Apotek sesuai dengan preferensi Anda, <br>
                    b) Fitur unggah resep disediakan bagi Anda yang ingin membeli produk resep, dan Anda wajib membawa resep aslinya ke {{ $apotek->apotic_name }} ketika melakukan pengambilan barang. Anda wajib mematuhi undang-undang dan peraturan yang berlaku terkait dengan penjualan dan penyerahan obat yang wajib dengan resep.
                </p>
            </div>
            <div class="flex gap-3">
                <p>2</p>
                <p>
                    {{ $apotek->apotic_name }} berhak sewaktu-waktu mengubah, menghapus, mengurangi, menambah dan/atau memperbarui fitur atau fasilitas dalam situs {{ $apotek->apotic_name }}. Pemakaian Anda yang berkelanjutan dianggap sebagai persetujuan kepada perubahan, penghapusan, pengurangan, penambahan dan/atau pembaruan fitur atau layanan {{ $apotek->apotic_name }}
                </p>
            </div>
            <div class="flex gap-3">
                <p>3</p>
                <p>
                    Dalam menggunakan fitur dan/atau layanan {{ $apotek->apotic_name }}, Anda dilarang untuk mengunggah atau menggunakan kata-kata, komentar, gambar, atau konten apapun yang mengandung unsur SARA, pornografi, hate speech (ungkapan buruk), perbuatan tidak menyenangkan, diskriminasi, merendahkan atau menyudutkan orang lain, vulgar, tindakan bersifat ancaman, atau hal-hal lain yang dapat dianggap tidak sesuai dengan nilai dan norma sosial. {{ $apotek->apotic_name }} berhak melakukan tindakan yang diperlukan atas pelanggaran ketentuan ini, antara lain penghapusan konten, moderasi toko, pemblokiran akun, dan lain-lain
                </p>
            </div>
        </div>

        {{-- H --}}
        <div class="flex flex-col gap-1 bg-red-600 text-white px-8 py-4">
            <b>H. PEMBATASAN TANGGUNG JAWAB</b>
            <div class="flex gap-3">
                PENGGUNAAN ANDA ATAS KEANGGOTAAN DAN SITUS {{ $apotek->apotic_name }} ADALAH RISIKO ANDA. SITUS {{ $apotek->apotic_name }} DAN SELURUH FITUR SERTA LAYANAN DI DALAMNYA DISEDIAKAN "SEBAGAIMANA ADANYA" DAN "SEBAGAIMANA TERSEDIA". {{ $apotek->apotic_name }} TIDAK MENJAMIN, BAIK TERSURAT MAUPUN TERSIRAT, ATAS KELENGKAPAN DAN KESESUAIAN SITUS {{ $apotek->apotic_name }} DAN SELURUH FITUR SERTA LAYANAN DI DALAMNYA UNTUK TUJUAN TERTENTU, YANG DIBUTUHKAN OLEH ANDA. {{ $apotek->apotic_name }} TIDAK MEMBERIKAN JAMINAN BAHWA (I) KEANGGOTAAN ANDA TIDAK AKAN TERGANGGU, ATAU BEBAS DARI KESALAHAN, (II) HASIL YANG DIPEROLEH OLEH ANDA DARI SITUS {{ $apotek->apotic_name }} ADALAH AKURAT ATAU DAPAT DIANDALKAN, ATAU (III) KUALITAS PRODUK, LAYANAN, INFORMASI, ATAU MATERI LAINNYA YANG DIDAPATKAN OLEH ANDA MELALUI SITUS {{ $apotek->apotic_name }}
            </div>
        </div>
        {{-- H --}}

        {{-- I --}}
        <div class="flex flex-col gap-1">
            <b>I. PILIHAN HUKUM</b>
            <div class="flex gap-3">
                Syarat dan Ketentuan ini diatur dan ditafsirkan sesuai dengan hukum Republik Indonesia, tanpa memerhatikan pertentangan aturan hukum. Anda menyatakan setuju bahwa tindakan hukum apapun atau sengketa yang mungkin timbul, serta berhubungan dan/ atau berada dalam cara apapun yang berhubungan dengan Anda dan Situs {{ $apotek->apotic_name }} dan/atau Syarat dan Ketentuan ini akan diselesaikan dengan cara eksklusif dalam yurisdiksi pengadilan Republik Indonesia
            </div>
        </div>
        {{-- I --}}

        {{-- J --}}
        <div class="flex flex-col gap-1">
            <b>J. LAIN-LAIN</b>
            <div class="flex">
                {{ $apotek->apotic_name }} akan melakukan upaya yang wajar untuk menjaga Situs {{ $apotek->apotic_name }} dapat berfungsi dan berjalan dengan baik. Namun, {{ $apotek->apotic_name }} tidak bertanggung jawab atas ketidaktersediaan Aplikasi dan Situs {{ $apotek->apotic_name }}, fitur-fitur dan/atau layanan-layanan yang disebabkan oleh berbagai alasan, termasuk tidak terbatas pada keperluan pemeliharaan atau masalah teknis.
            </div>
            <br>
            <div id="contact" class="flex">
                <p>Semua permintaan informasi, penyampaian masalah atau keluhan akan diproses jika Anda menyampaikan melalui Whatsapp ke <span class="font-bold">081234567890</span></p>
            </div>
        </div>
        {{-- J --}}

    </main>
    {{-- MAIN --}}


    @include('user.components.footer')
</body>
</html>