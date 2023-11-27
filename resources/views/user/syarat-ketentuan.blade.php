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
            <b>Selamat datang di Apotek Jati Negara!</b>
            <p>Informasi Apotek :</p>
            
            <table class="w-3/4">
                <tr>
                    <td class="w-1/3">Nama Apotek</td>
                    <td class="w-2/3">: Apotek Jati Negara </td>
                </tr>
                <tr>
                    <td>Website</td>
                    <td>: ApotekJatiNegara.com</td>
                </tr>
                <tr>
                    <td>Nomor SIA</td>
                    <td>: 0126/SK-APT/DPMPTSP/MDN/3.3/VIII/2021</td>
                </tr>
                <tr>
                    <td>Penanggung Jawab Apotek</td>
                    <td>: apt. Sasmita Irawati S.Si</td>
                </tr>
                <tr>
                    <td>Nomor SIPA</td>
                    <td>: 3150/SIP/DPMPTSP/MDN/3.1/VII/2021</td>
                </tr>
                <tr>
                    <td>Alamat Apotek</td>
                    <td>: Jl. Prof H.M Yamin No 134 Medan</td>
                </tr>
                <tr>
                    <td class="flex">Jam Operasional</td>
                    <td>Senin : 09.00 WIB - 20.00 WIB <br>
                        Selasa : 09.00 WIB - 20.00 WIB <br>
                        Rabu : 09.00 WIB - 20.00 WIB <br>
                        Kamis : 09.00 WIB - 20.00 WIB <br>
                        Jumat : 09.00 WIB - 20.00 WIB <br>
                        Sabtu : 09.00 WIB - 20.00 WIB <br>
                        Minggu : 09.00 WIB - 20.00 WIB</td>
                </tr>
            </table>
        </div>

        <div class="flex flex-col gap-4">
            <p>
                Syarat dan ketentuan ini mengatur tata cara penggunaan fitur-fitur dan/atau layanan-layanan mengenai penggunaan dan/atau pemanfaatan Situs Apotek Jati Negara.
            </p>
            <p>
                Dengan mendaftar, menggunakan, dan/atau mengakses Situs Apotek Jati Negara ini maka Anda setuju dengan syarat dan ketentuan  yang ditetapkan Apotek Jati Negara. Jika Anda tidak setuju dengan syarat dan ketentuan berikut ini, maka Anda dapat berhenti mengakses layanan Apotek Jati Negara.
            </p>
            <p>
                Apotek Jati Negara berhak sewaktu-waktu mengubah, menghapus dan menerapkan ketentuan baru dalam Syarat dan Ketentuan ini. Dengan mendaftar, menggunakan, dan/atau melakukan akses ke Situs Apotek Jati Negara, maka Anda secara mandiri dan sukarela telah membaca, mengerti, memahami, dan menyetujui seluruh isi dalam Syarat dan Ketentuan ini (termasuk Kebijakan Privasi).
            </p>
        </div>

        {{-- A --}}
        <div class="flex flex-col gap-1">
            <b>A. DEFINISI</b>
            <div class="flex gap-3">
                <p>1</p>
                <p>
                    Apotek Jati Negara adalah situs ApotekJatiNegara.com yang dimiliki, dikelola dan ditawarkan oleh Apotek Jati Negara, yang mana situs ApotekJatiNegara.com tersebut dapat diakses pada perangkat handphone & PC Anda. 
                </p>
            </div>
            <div class="flex gap-3">
                <p>2</p>
                <p>
                    Syarat dan Ketentuan adalah kesepakatan antara Anda dan Apotek Jati Negara yang mengatur hak dan kewajiban, serta tanggung jawab masing-masing pihak termasuk tata cara penggunaan situs Apotek Jati Negara. 
                </p>
            </div>
            <div class="flex gap-3">
                <p>3</p>
                <p>
                    Anda adalah setiap orang atau pihak yang secara mandiri dan sukarela melakukan pendaftaran di Situs Apotek Jati Negara 
                </p>
            </div>
            <div class="flex gap-3">
                <p>4</p>
                <p>
                    Rekening Resmi Apotek Jati Negara adalah rekening bersama yang disepakati oleh Apotek Jati Negara dan Anda untuk proses transaksi jual beli di Apotek Jati Negar
                </p>
            </div>
        </div>
        {{-- A --}}
    
        {{-- B --}}
        <div class="flex flex-col gap-1">
            <b>B. PENGGUNAAN APOTEK JATI NEGARA</b>
            <div class="flex gap-3">
                <p>1</p>
                <p>
                    Dengan mengakses, mendaftar, dan/atau menggunakan situs Apotek Jati Negara, maka Anda menyatakan bahwa Anda adalah pribadi yang cakap secara hukum dan Anda telah membaca, memahami, dan menyetujui semua Syarat dan Ketentuan penggunaan situs Apotek Jati Negara. Pada saat Anda mengakses dan menggunakan Apotek Jati Negara, maka Anda setuju untuk mematuhi Syarat dan Ketentuan (termasuk Kebijakan Privasi) yang diberlakukan oleh pihak Apotek Jati Negara.
                </p>
            </div>
            <div class="flex gap-3">
                <p>2</p>
                <p>
                    Anda dilarang untuk: <br> 
                    a) menyebarkan bug, spam, virus, worm, logic bom atau mengirimkan atau teknologi sejenis lainnya atau materi-materi berbahaya yang dapat merusak, merugikan dan/atau mengganggu kinerja seluruh akses terhadap Apotek Jati Negara <br> 
                    b)mengalihkan akun Anda kepada pihak lain <br>
                    c) memperoleh, mengambil atau mengumpulkan data milik lainnya, secara tanpa hak atau melawan hukum <br>
                    d) menggunakan situs Apotek Jati Negara untuk melakukan kegiatan komersial apapun <br> 
                    e) menggunakan Apotek Jati Negara termasuk fitur-fitur dan layanan-layanannya untuk hal-hal yang dilarang oleh peraturan perundang-undangan yang berlaku.
                </p>
            </div>
            <div class="flex gap-3">
                <p>3</p>
                <p>
                    Setiap tindakan yang merupakan pelanggaran ketentuan peraturan perundang-undangan termasuk Undang-undang No 11 tahun 2008 tentang Internet dan Transaksi Elektronik (ITE) sebagaimana diubah dari waktu-waktu, yang dilakukan oleh Anda, maka Apotek Jati Negara berhak melaporkan pelanggaran kepada pihak yang berwajib. Apotek Jati Negara dapat menggunakan jasa pihak ketiga termasuk namun tidak terbatas terkait penyediaan layanan pembayaran. Karena itu segala bentuk kegagalan sistem terkait yang disebabkan hal yang di luar kendali Apotek Jati Negara termasuk namun tidak terbatas terkait dengan layanan pembayaran yang disediakan pihak ketiga adalah di luar tanggung jawab Apotek Jati Negara. Namun demikian, Apotek Jati Negara akan berupaya maksimal untuk membantu menyelesaikan masalah yang mungkin timbul
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
                    Apotek Jati Negara tidak akan meminta password akun Anda untuk alasan apapun, oleh karena itu Apotek Jati Negara menghimbau Anda agar tidak memberikan password kepada pihak manapun, baik kepada pihak ketiga maupun kepada pihak yang mengatasnamakan Apotek Jati Negara. 
                </p>
            </div>
            <div class="flex gap-3">
                <p>3</p>
                <p>
                    Anda dapat mengakhiri keanggotaan Anda dengan cara menghapus akun pada situs Apotek Jati Negara.
                </p>
            </div>
            <div class="flex gap-3">
                <p>4</p>
                <p>
                    Apotek Jati Negara berhak untuk menghentikan penggunaan Apotek Jati Negara apabila Apotek jati Negara memiliki alasan bahwa Anda telah melanggar Syarat dan Ketentuan ini (termasuk Kebijakan Privasi) atau peraturan perundang-undangan yang berlaku
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
                    b. Dengan melakukan pembelian di Apotek Jati Negara, Anda setuju melakukan kontrak pembelian produk yang mengikat secara hukum.
                </p>
            </div>
            <div class="flex gap-3">
                <p>2</p>
                <p>
                    Anda memahami bahwa ketersediaan stok produk dapat berubah sewaktu-waktu, sehingga Apotek Jati Negara dapat menolak pesanan/order.
                </p>
            </div>
            <div class="flex gap-3">
                <p>3</p>
                <p>
                    Anda memahami sepenuhnya dan menyetujui bahwa pada dasarnya transaksi yang dilakukan adalah antara Anda sebagai pembeli dan Apotek Jati Negara sebagai penjual
                </p>
            </div>
            <div class="flex gap-3">
                <p>4</p>
                <p>
                    Anda memahami sepenuhnya dan menyetujui bahwa segala transaksi yang dilakukan antara Anda dan Apotek Jati Negara selain melalui rekening resmi Apotek Jati Negara dan/atau tanpa sepengetahuan Apotek Jati Negara (melalui fasilitas/jaringan pribadi, pengiriman pesan, pengaturan transaksi khusus di luar Situs Apotek Jati Negara atau bentuk lainnya) merupakan tanggung jawab pribadi dari Anda.
                </p>
            </div>
            <div class="flex gap-3">
                <p>5</p>
                <p>
                    Anda memahami dan menyetujui bahwa masalah keterlambatan proses pembayaran dan biaya tambahan yang disebabkan oleh perbedaan bank yang Anda gunakan dengan bank rekening resmi Apotek Jati Negara adalah tanggung jawab Anda sepenuhnya.
                </p>
            </div>
            <div class="flex gap-3">
                <p>6</p>
                <p>
                    Pengembalian dana dari Apotek Jati Negara kepada Anda akan ditransfer ke rekening Anda atau melalui fitur e-wallet account (jika tersedia) Anda dimulai dari jam 19.00 sampai jam 21.00 di hari Senin - Sabtu dan hanya dapat dilakukan jika dalam keadaan-keadaan tertentu seperti berikut ini: <br>
                    a) Kelebihan pembayaran dari Anda atas nilai transaksi yang terdiri dari harga produk beserta biaya-biaya lainnya (jika ada), yang oleh Anda secara tertulis diminta untuk dikembalikan secara transfer ke rekening Anda yang sah atau dipindahkan ke e-wallet account (jika ada) Anda. <br>
                    b) Pengembalian produk disebabkan oleh permasalahan produk tidak sesuai dengan spesifikasi atau permasalahan lainnya yang diatur oleh peraturan perundang-undangan yang berlaku di Indonesia. <br>
                    c) Stok obat yang tidak tersedia setelah pembayaran dilakukan.
                </p>
            </div>
            <div class="flex gap-3">
                <p>7</p>
                <p>
                    Transaksi yang sudah direspon oleh Apotek Jati Negara tidak dapat dibatalkan, kecuali dalam kondisi adanya pembatalan dari pihak Apotek Jati Negara
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
                    Apotek Jati Negara berhak membatalkan pesanan apabila ditemukan adanya indikasi kecurangan/pelanggaran yang merugikan Apotek Jati Negara
                </p>
            </div>
        </div>
        {{-- D --}}

        {{-- E --}}
        <div class="flex flex-col gap-1">
            <b>E. OPERASIONAL APOTEK JATI NEGARA</b>
            <div class="flex gap-3">
                <p>1</p>
                <p>
                    Untuk pembelian produk yang menggunakan resep, Anda akan menerima balasan dari Apotek Jati Negara tentang diterima atau tidaknya pesanan produk yang menggunakan resep tersebut dalam batas waktu 1 x 24 jam. Apabila dalam waktu 1 x 24 jam tidak ada konfirmasi atau balasan dari pihak Apotek, Anda dapat menghubungi customer service Apotek Jati Negara untuk bantuan lebih lanjut 
                </p>
            </div>
            <div class="flex gap-3">
                <p>2</p>
                <p>
                    Apabila Apotek Jati Negara menyetujui untuk menerima pesanan Anda, maka Apotek Jati Negara akan menyimpan/book obat sesuai pesanan anda selama 3 x 24 jam
                </p>
            </div>
            <div class="flex gap-3">
                <p>3</p>
                <p>
                    Pesanan hanya dilayani di jam operasional Apotek Jati Negara yaitu: <br>
                    Senin : 09.00 WIB - 20.00 WIB <br>
                    Selasa : 09.00 WIB - 20.00 WIB <br>
                    Rabu : 09.00 WIB - 20.00 WIB <br>
                    Kamis : 09.00 WIB - 20.00 WIB <br>
                    Jumat : 09.00 WIB - 20.00 WIB <br>
                    Sabtu : 09.00 WIB - 20.00 WIB <br>
                    Minggu : 09.00 WIB - 20.00 WIB
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
                    Harga produk yang dijual oleh Apotek Jati Negara dan ditayangkan di situs ApotekJatiNegara.com adalah harga yang ditetapkan oleh Apotek Jati Negara. Harga produk tersebut tidak mengikat, dan dapat berubah sewaktu-waktu, sesuai kebijakan Apotek
                </p>
            </div>
            <div class="flex gap-3">
                <p>2</p>
                <p>
                    Apabila terdapat informasi dari Apotek yang menyatakan bahwa harga produk yang dijualnya di situs ApotekJatiNegara.com belum harga yang terkini, maka Apotek berhak membatalkan transaksi atau menagih kekurangan maupun kelebihan biaya yang timbul atas perbedaan harga tersebut dengan disertai dokumen pendukung yang sah
                </p>
            </div>
            <div class="flex gap-3">
                <p>3</p>
                <p>
                    Dengan melakukan pemesanan melalui Apotek Jati Negara, Anda menyetujui untuk membayar total biaya yang harus dibayarkan sebagaimana tertera dalam halaman pembayaran, yang terdiri dari harga produk, dan biaya-biaya lain yang mungkin timbul dan diuraikan secara tegas dalam halaman pembayaran. Anda setuju untuk melakukan pembayaran melalui metode pembayaran yang telah disediakan untuk Anda
                </p>
            </div>
            <div class="flex gap-3">
                <p>4</p>
                <p>
                    Transaksi di Apotek Jati Negara hanya bisa dalam mata uang Rupiah
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
                    Fitur atau layanan yang dapat digunakan oleh Anda di Situs Apotek Jati Negara adalah sebagai berikut: <br>
                    a) Melalui Situs Apotek Jati Negara, Anda dapat melakukan pembelian produk-produk kesehatan melalui Apotek sesuai dengan preferensi Anda, <br>
                    b) Fitur unggah resep disediakan bagi Anda yang ingin membeli produk resep, dan Anda wajib membawa resep aslinya ke Apotek Jati Negara ketika melakukan pengambilan barang. Anda wajib mematuhi undang-undang dan peraturan yang berlaku terkait dengan penjualan dan penyerahan obat yang wajib dengan resep.
                </p>
            </div>
            <div class="flex gap-3">
                <p>2</p>
                <p>
                    Apotek Jati Negara berhak sewaktu-waktu mengubah, menghapus, mengurangi, menambah dan/atau memperbarui fitur atau fasilitas dalam situs Apotek Jati Negara. Pemakaian Anda yang berkelanjutan dianggap sebagai persetujuan kepada perubahan, penghapusan, pengurangan, penambahan dan/atau pembaruan fitur atau layanan Apotek Jati Negara
                </p>
            </div>
            <div class="flex gap-3">
                <p>3</p>
                <p>
                    Dalam menggunakan fitur dan/atau layanan Apotek Jati Negara, Anda dilarang untuk mengunggah atau menggunakan kata-kata, komentar, gambar, atau konten apapun yang mengandung unsur SARA, pornografi, hate speech (ungkapan buruk), perbuatan tidak menyenangkan, diskriminasi, merendahkan atau menyudutkan orang lain, vulgar, tindakan bersifat ancaman, atau hal-hal lain yang dapat dianggap tidak sesuai dengan nilai dan norma sosial. Apotek Jati Negara berhak melakukan tindakan yang diperlukan atas pelanggaran ketentuan ini, antara lain penghapusan konten, moderasi toko, pemblokiran akun, dan lain-lain
                </p>
            </div>
        </div>

        {{-- H --}}
        <div class="flex flex-col gap-1 bg-red-600 text-white px-8 py-4">
            <b>H. PEMBATASAN TANGGUNG JAWAB</b>
            <div class="flex gap-3">
                PENGGUNAAN ANDA ATAS KEANGGOTAAN DAN SITUS APOTEK JATI NEGARA ADALAH RISIKO ANDA. SITUS APOTEK JATI NEGARA DAN SELURUH FITUR SERTA LAYANAN DI DALAMNYA DISEDIAKAN "SEBAGAIMANA ADANYA" DAN "SEBAGAIMANA TERSEDIA". APOTEK JATI NEGARA TIDAK MENJAMIN, BAIK TERSURAT MAUPUN TERSIRAT, ATAS KELENGKAPAN DAN KESESUAIAN SITUS APOTEK JATI NEGARA DAN SELURUH FITUR SERTA LAYANAN DI DALAMNYA UNTUK TUJUAN TERTENTU, YANG DIBUTUHKAN OLEH ANDA. APOTEK JATI NEGARA TIDAK MEMBERIKAN JAMINAN BAHWA (I) KEANGGOTAAN ANDA TIDAK AKAN TERGANGGU, ATAU BEBAS DARI KESALAHAN, (II) HASIL YANG DIPEROLEH OLEH ANDA DARI SITUS APOTEK JATI NEGARA ADALAH AKURAT ATAU DAPAT DIANDALKAN, ATAU (III) KUALITAS PRODUK, LAYANAN, INFORMASI, ATAU MATERI LAINNYA YANG DIDAPATKAN OLEH ANDA MELALUI SITUS APOTEK JATI NEGARA
            </div>
        </div>
        {{-- H --}}

        {{-- I --}}
        <div class="flex flex-col gap-1">
            <b>I. PILIHAN HUKUM</b>
            <div class="flex gap-3">
                Syarat dan Ketentuan ini diatur dan ditafsirkan sesuai dengan hukum Republik Indonesia, tanpa memerhatikan pertentangan aturan hukum. Anda menyatakan setuju bahwa tindakan hukum apapun atau sengketa yang mungkin timbul, serta berhubungan dan/ atau berada dalam cara apapun yang berhubungan dengan Anda dan Situs Apotek Jati Negara dan/atau Syarat dan Ketentuan ini akan diselesaikan dengan cara eksklusif dalam yurisdiksi pengadilan Republik Indonesia
            </div>
        </div>
        {{-- I --}}

        {{-- J --}}
        <div class="flex flex-col gap-1">
            <b>J. LAIN-LAIN</b>
            <div class="flex">
                Apotek Jati Negara akan melakukan upaya yang wajar untuk menjaga Situs Apotek Jati Negara dapat berfungsi dan berjalan dengan baik. Namun, Apotek jati Negara tidak bertanggung jawab atas ketidaktersediaan Aplikasi dan Situs Apotek Jati Negara, fitur-fitur dan/atau layanan-layanan yang disebabkan oleh berbagai alasan, termasuk tidak terbatas pada keperluan pemeliharaan atau masalah teknis.
            </div>
            <br>
            <div class="flex">
                Semua permintaan informasi, penyampaian masalah atau keluhan akan diproses jika Anda menyampaikan melalui Whatsapp ke 081234567890
            </div>
        </div>
        {{-- J --}}

    </main>
    {{-- MAIN --}}


    @include('user.components.footer')
</body>
</html>