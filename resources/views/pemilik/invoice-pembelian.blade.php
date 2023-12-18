<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Invoice {{ $invoice_number }}</title>
    @vite('resources/css/app.css')
    
    <style>
        th {
            height: 30px
        }

        td {
            padding-left: 10px;
            padding-right: 10px;
            min-height: 50px;
            height: 70px;
            max-height: fit-content;
        }

        tr {
            border-bottom: 2px solid black;
        }
        /* Gaya khusus untuk cetak */
        @media print {
            body {
                font-size: 12pt;
                -webkit-print-color-adjust: exact;
            }
  
            .background_black {
              background-color: black !important;
              color: white !important;
            }
  
            /* Sembunyikan elemen yang tidak perlu dicetak */
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body class="flex justify-center font-Roboto bg-gray-100">

    <div class="fixed right-10 top-8 print:hidden">
        <button onclick="prints()" type="button" class="bg-black text-white font-semibold px-4 py-2 rounded-md">Download Invoice</button>
    </div>

    <section class="w-[45rem] print:w-full bg-white flex flex-col print:justify-between print:h-full">
        <header class="mt-16">
            <nav class="flex justify-between">
                <div class="bg-black px-7 py-6 w-[50%] flex justify-end items-center">
                    <p class="tracking-widest text-4xl text-white font-semibold">INVOICE</p>
                </div>

                <div class="flex items-center gap-6 w-fit justify-end">
                    <div class="flex flex-col font-bold items-end">
                        <p class="tracking-widest text-2xl">INVOICE NUMBER</p>
                        <p class="text-mediumGrey text-lg">{{ $invoice_number }}</p>
                    </div>

                    <div class="bg-black h-10 aspect-square"></div>
                </div>
            </nav>
        </header>

        <main>
            <div class="py-8 tracking-wider flex flex-col gap-4">
                <p class="font-bold pl-20 text-xl">APOTEK JATI NEGARA</p>
                <hr class="w-64 border border-black">

                <div class="flex flex-col pl-20 gap-4">
                    <p class="font-bold">DIBERIKAN KEPADA :</p>
                    <div class="flex flex-col">
                        <p class="font-bold text-xl">{{ $invoice->supplier_name }}</p>
                        <p class="font-bold text-mediumGrey">{{ $supplier->supplier_phone }}</p>
                        <p class="font-bold text-mediumGrey w-[60%]">{{ $supplier->supplier_address }}</p>
                    </div>
                </div>
            </div>

            <div class="w-full flex justify-center">
                <table class="w-[90%]">
                    <tr class="bg-black text-white">
                        <th class="w-[35ch] tracking-widest">PRODUK</th>
                        <th class="tracking-widest">HARGA</th>
                        <th class="tracking-widest">JUMLAH</th>
                        <th class="tracking-widest">TOTAL</th>
                    </tr>
                    @php
                        $total = 0;
                    @endphp
                    @foreach ($invoice->buyingInvoiceDetail as $product)
                    @php
                        $total += $product->product_buy_price * $product->quantity;
                    @endphp
                    <tr>
                        <td>{{ $product->product_name }}</td>
                        <td class="text-center">Rp. {{ number_format($product->product_buy_price, 0, ',', '.') }}</td>
                        <td class="text-center">{{ $product->quantity }}</td>
                        <td class="text-center">Rp. {{ number_format($product->product_buy_price * $product->quantity, 0, ',', '.') }}</td>
                    </tr>
                    @endforeach
                </table>
            </div>

            <div class="w-full flex justify-center pt-4">
                <div class="w-[90%] flex justify-between">
                    <p class="font-bold tracking-widest">TOTAL : </p>
                    <p class="font-bold">Rp. {{ number_format($total, 0, ',', '.') }}</p>
                </div>
            </div>

            <div class="w-full flex justify-center pt-4">
                <div class="flex flex-col w-[90%] font-semibold">
                    <p>Metode Pembayaran : <span class="font-bold"> Tunai </span> </p>
                    <p>Tanggal Pembelian : <span class="font-bold"> {{ date('d M Y',strtotime($invoice->order_date)) }} </span> </p>
                </div>
            </div>  

            <div class="w-full flex justify-center pt-4">
                <div class="flex flex-col w-[90%]">
                    <p class="font-bold text-xl tracking-widest">SYARAT DAN KETENTUAN</p>
                    <p class="font-semibold text-mediumGrey">Transaksi yang sudah direspon oleh Apotek Jati Negara tidak dapat dibatalkan, kecuali dalam kondisi adanya pembatalan dari pihak Apotek Jati Negara</p>
                </div>
            </div>  
        </main>

        <footer class="w-full flex justify-center mt-16 print:mt-10">
            <div class="bg-black text-white flex justify-between w-[90%] px-16 py-8">
                <div class="flex flex-col justify-center w-3/5">
                    <p class="text-xl tracking-widest font-bold">APOTEK JATI NEGARA</p>
                    <p class="text-md font-semibold">CP : 0812-3456-7890 (Aliong)</p>
                </div>
                
                <div class="w-2/5">
                    <p>Jl. Prof. H. M. Yamin No.116, Sidodadi, Kec. Medan Timur, Kota Medan, Sumatera Utara 20233</p>
                </div>
            </div>
        </footer>

    </section>

    <script>
        function prints() {
            window.print();
        }
    </script>
</body>
</html>