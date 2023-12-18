<div>
    <form action="{{ route('cetak-report') }}" class="mb-10" method="post">
        @csrf
        <input wire:change="cari" wire:model="tanggalTransaksi" value="{{ $tanggalTransaski ?? '' }}" type="month" name="tanggal" id="tanggal" class="w-fit p-3 rounded-lg shadow-lg border-none" 
        placeholder="Pilih Bulan" data-input required>
        <button type="submit" class="text-white bg-blue-700 w-fit ml-3 p-3 rounded-lg shadow-lg border-none">Cetak Laporan</button>
    </form>

            <div class="bg-white rounded-lg p-4 shadow-md overflow-x-auto">
                <table id="myTable" class="table table-striped w-full text-xl">
                    <thead>
                        <tr class="h-16">
                            <th>No</th>
                            <th class="text-left">Tanggal Transaksi</th>
                            <th class="text-left">No. Invoice</th>
                            <th>Tipe Transaksi</th>
                            <th>Metode Pembayaran</th>
                            <th>Total</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $j = 1;
                        @endphp
                        @foreach ($last as $lastest)
                        <tr class="h-14">
                            <td class="text-center w-24">{{$j++}}</td>
                            @php
                            $carbonDate = \Carbon\Carbon::parse( $lastest->tanggal_transaksi);
                            $formattedDate = $carbonDate->format('j F Y');
                            @endphp
                            <td class="w-64">
                                <span class="font-bold">{{ $formattedDate }}</span>
                            </td>
                            <td class="w-80">{{ $lastest->invoice_code }}</td>
                            <td class="text-center w-44">{{ $lastest->tipe_transaksi }}</td>
                            <td class="text-center w-60">{{ $lastest->metode_pembayaran }}</td>
                            <td class="text-center font-bold">Rp
                                {{ number_format($lastest->total_pengeluaran , 0, ',', '.') }}
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
    </div>