<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.17.5/xlsx.full.min.js"></script>

    <?php
        \Carbon\Carbon::setLocale('id');
        $formattedMonth = \Carbon\Carbon::create()->month($month)->isoFormat('MMMM');
    ?>
    <title>Laporan Keuangan Bulan {{ $formattedMonth }} {{ $year }} </title>    @vite('resources/css/app.css')

    <style>
      /* Gaya khusus untuk cetak */
      @media print {
          body {
              font-size: 12pt;
              -webkit-print-color-adjust: exact;
          }
          @page {
            size: landscape; /* Menetapkan orientasi halaman menjadi landscape */
          }

          .background_black {
            background-color: black !important;
            color: white !important;
          }

          /* Sembunyikan elemen yang tidak perlu dicetak */
          .no-print {
              display: none;
          }

        .print\:w-1\/6 { width: 16.66667%; }
        .print\:w-1\/2 { width: 50%; }
        .print\:w-1\/3 { width: 33.33333%; }
        .print\:w-2\/3 { width: 66.66667%; }
        .print\:w-4\/5 { width: 80%; }
  
      }
  </style>
</head>
<body class="font-Inter">
  <div class="no-print w-screen flex">
    <button type="button" onclick="prints()" class="no-print bg-mainColor rounded-lg px-5 py-3 my-5 text-end text-white m-auto mr-1">Unduh Halaman sebagai PDF</button>
    {{-- <button type="button" onclick="exportToCSV()" class="no-print bg-mainColor rounded-lg px-5 py-3 my-5 text-end text-white m-auto ml-1">Unduh Tabel sebagai CSV</button> --}}
    <button type="button" onclick="exportToExcel()" class="no-print bg-mainColor rounded-lg px-5 py-3 my-5 text-end text-white m-auto ml-1">Unduh Tabel sebagai Excel</button>
  </div>
<div class="pt-10" id="print-content">
  <button class="w-[140px] h-[40px] ms-8 bg-black background_black rounded-tl-3xl rounded-br-3xl shadow text-xl text-white font-bold text-center">Jati Negara</button>
    <div class="p-8">
      <div class="mt-4">
      <table class="w-full" id="report">
          <thead>
            <tr>
              <th class="bg-zinc-600 text-white font-bold font-Inter px-2 py-1">No</th>
              <th class="bg-zinc-600 text-white font-bold font-Inter px-2 py-1">Tanggal Transaksi</th>
              <th class="bg-zinc-600 text-white font-bold font-Inter px-2 py-1">No.Invoice</th>
              <th class="bg-zinc-600 text-white font-bold font-Inter px-2 py-1">Tipe Transaksi</th>
              <th class="bg-zinc-600 text-white font-bold font-Inter px-2 py-1">Metode Pembayaran</th>            
              <th class="print:w-1/6 bg-zinc-600 text-white font-bold font-Inter px-2 py-1">Pengeluaran</th>            
              <th class="print:w-1/6 bg-zinc-600 text-white font-bold font-Inter px-2 py-1">Pemasukan</th>            
            </tr>
          </thead>
          <tbody class="text-center">
            @php
                $i=1;
                $pengeluaran = 0; 
                $pemasukan = 0;
                $total = 0;
            @endphp
            @foreach ($reports as $report)
            <tr>
              <td class="bg-white border border-black border-opacity-30 px-2 py-1">{{ $i }}</td>
              <td class="bg-white border border-black border-opacity-30 px-2 py-1">{{ date('d M Y',strtotime($report->tanggal_transaksi)) }}</td>
              <td class="bg-white border border-black border-opacity-30 px-2 py-1">{{ $report->invoice_code }}</td>
              <td class="bg-white border border-black border-opacity-30 px-2 py-1">{{ $report->tipe_transaksi }}</td>
              <td class="bg-white border border-black border-opacity-30 px-2 py-1">{{ $report->metode_pembayaran}}</td>
              @if($report->tipe_transaksi=='Pembelian')
                <td class="bg-white border border-black border-opacity-30 text-right px-2 py-1">Rp. {{ number_format($report->total_pengeluaran, 0, ',', '.') }}</td>
                @php $pengeluaran += $report->total_pengeluaran @endphp
                <td class="bg-white border border-black border-opacity-30 text-right px-2 py-1"></td>
                @elseif($report->tipe_transaksi=='Penjualanan')
                <td class="bg-white border border-black border-opacity-30 text-right px-2 py-1"></td>
                <td class="bg-white border border-black border-opacity-30 text-right px-2 py-1">Rp. {{ number_format($report->total_pengeluaran, 0, ',', '.') }}</td>
                @php $pemasukan += $report->total_pengeluaran @endphp
              @endif
                @php $i++; @endphp
              @endforeach
            </tr>
            <tr>
              <td colspan="5" class="bg-white border font-bold text-lg border-black border-opacity-30 text-center px-2 py-1">Total</td>
              {{-- <td class="bg-white border font-bold text-lg border-black border-opacity-30 text-center px-2 py-1"></td>
              <td class="bg-white border font-bold text-lg border-black border-opacity-30 text-center px-2 py-1"></td>
              <td class="bg-white border font-bold text-lg border-black border-opacity-30 text-center px-2 py-1"></td>
              <td colspan="4"class="bg-white border font-bold text-lg border-black border-opacity-30 text-center px-2 py-1">Total</td> --}}
                <td class="bg-white border border-black border-opacity-30 text-right px-2 py-1">
                  Rp. {{ number_format($pengeluaran, 0, ',', '.') }}
                </td>
                <td class="bg-white border border-black border-opacity-30 text-right px-2 py-1">
                  Rp. {{ number_format($pemasukan, 0, ',', '.') }}
                </td>
            </tr>

            @php
                $total = $pemasukan - $pengeluaran;
            @endphp

            <tr>
              <td colspan="5" class="bg-white border font-bold text-lg border-black border-opacity-30 text-center px-2 py-1"></td>
              {{-- <td class="bg-white border font-bold text-lg border-black border-opacity-30 text-center px-2 py-1"></td>
              <td class="bg-white border font-bold text-lg border-black border-opacity-30 text-center px-2 py-1"></td>
              <td class="bg-white border font-bold text-lg border-black border-opacity-30 text-center px-2 py-1"></td>
              <td class="bg-white border font-bold text-lg border-black border-opacity-30 text-center px-2 py-1"></td> --}}
              @if($total >= 0)
                <td class="bg-white border font-bold border-black border-opacity-30 text-center px-2 py-1"></td>
                <td class="bg-white border font-bold border-black border-opacity-30 text-right px-2 py-1">
                  Rp. {{ number_format($total, 0, ',', '.') }}
                </td>
              @elseif($total < 0)
              <td class="bg-white border font-bold border-black border-opacity-30 text-right px-2 py-1">
                Rp. {{ number_format($total, 0, ',', '.') }}
              </td>
              <td class="bg-white border font-bold border-black border-opacity-30 text-center px-2 py-1"></td>
              @endif
            </tr>
          </tbody>
        </table>
      </div>
</div>

<script>
  function prints() {
            window.print();
        }

  function exportToExcel() {
    // Mendapatkan tabel yang ingin di-convert
    var table = document.getElementById('report'); // Gantilah 'your-table-id' dengan ID tabel Anda

    // Mendapatkan data dari setiap sel
    var data = [];

    // Baris pertama untuk keterangan dinamis
    data.push(['LAPORAN KEUANGAN APOTEK JATI NEGARA']);

    // Baris kedua untuk bulan dan tahun (dikapital dan bold)
    var formattedMonth = '{{ $formattedMonth }}'.toUpperCase();
    var formattedYear = '{{ $year }}'.toUpperCase();
    data.push([{
        t: 's',  // t: 's' menunjukkan teks
        v: formattedMonth + ' ' + formattedYear,
        s: { font: { bold: true } }  // Properti 'bold' untuk tebal
    }]);

    // Baris ketiga dapat diisi dengan teks atau dikosongkan
    data.push([]);

    // Baris keempat untuk header kolom
    data.push([]);

    // Mendapatkan header kolom dari tabel dan memasukkannya ke baris keempat
    for (var i = 0; i < table.rows[0].cells.length; i++) {
        data[3].push(table.rows[0].cells[i].innerText);
    }

    for (var i = 1; i < table.rows.length; i++) {
        var row = [];
        for (var j = 0; j < table.rows[i].cells.length; j++) {
            var cell = table.rows[i].cells[j];
            row.push({
                t: 's',
                v: cell.innerText
            });

            // Handle colspan
            if (cell.colSpan > 1) {
                for (var k = 1; k < cell.colSpan; k++) {
                    row.push({});
                }
            }

            // Handle rowspan
            if (cell.rowSpan > 1) {
                for (var k = 1; k < cell.rowSpan; k++) {
                    var nextRow = data[i + k] || [];
                    nextRow.push({});
                    data[i + k] = nextRow;
                }
            }
        }
        data.push(row);
    }

    // Membuat worksheet dari data
    var ws = XLSX.utils.aoa_to_sheet(data);

    // Menentukan lebar kolom untuk kolom tertentu
    ws['!cols'] = [
        { wch: 10 },  // Lebar kolom untuk kolom 1
        { wch: 15 },  // Lebar kolom untuk kolom 2
        { wch: 35 },  // Lebar kolom untuk kolom 3
        { wch: 15 },  // Lebar kolom untuk kolom 4
        { wch: 20 },  // Lebar kolom untuk kolom 5
        { wch: 20 },  // Lebar kolom untuk kolom 6
        { wch: 20 },  // Lebar kolom untuk kolom 7
        // Tambahkan kolom lain jika diperlukan
    ];
    

    // Menambahkan penggabungan otomatis untuk header kolom
    ws['!merges'] = [
        { s: { r: 0, c: 0 }, e: { r: 0, c: 6 } },
        { s: { r: 1, c: 0 }, e: { r: 1, c: 6 } },
      // Penggabungan untuk dua baris terakhir
        { s: { r: data.length - 2, c: 0 }, e: { r: data.length - 2, c: 4 } },
        { s: { r: data.length - 1, c: 0 }, e: { r: data.length - 1, c: 4 } },
    ];

    // Membuat workbook
    var wb = XLSX.utils.book_new();
    XLSX.utils.book_append_sheet(wb, ws, 'Sheet1');

    // Membuat file Excel dan mendownloadnya
    XLSX.writeFile(wb, 'tabel.xlsx');
}
</script>

</body>
</html>