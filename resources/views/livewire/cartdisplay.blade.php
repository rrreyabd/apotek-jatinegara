{{-- CART START --}}
<div class="w-[33%] bg-white py-10 px-8 flex flex-col justify-between gap-10 shadow-md">
    <div class="flex flex-col gap-4">
        <p class="font-bold text-2xl">Detail Pesanan</p>
        <hr class="border border-1 border-mediumGrey opacity-20 ">

        {{-- KONDISI TIDAK ADA ITEM DI KERANJANG --}}
        @if ($cartItems->isEmpty())
        <div class="h-[80vh] w-full flex justify-center items-center flex-col text-center gap-2">
            <i class="text-6xl text-mainColor fa-solid fa-cart-shopping"></i>
            <p class="font-semibold text-2xl text-mainColor">Tidak ada item di keranjang.</p>
        </div>
        {{-- KONDISI ADA ITEM DI KERANJANG --}}
        @else
        <div class="w-full flex flex-col gap-4">
            @foreach ($cartItems as $item)
            <div class="flex gap-2">
                <img src="https://i.pinimg.com/564x/22/04/72/2204725ec0bd13c61131bc099467b04c.jpg"
                    class="w-24 rounded-md" alt="">

                <div class="flex flex-col justify-between">
                    @if ($item->product->description->product_type == "resep dokter")
                    <p class="bg-red-600 text-white w-fit px-2 py-1 text-sm rounded-md font-semibold">Resep</p>
                    @endif
                    <p class="w-full font-semibold text-base namaObat leading-tight break-words">{{
                        $item->product->product_name }}</p>
                    <div class="flex justify-between">
                        <div class="w-[50%] text-secondaryColor font-bold break-all leading-tight">
                            Rp. {{
                            number_format($item->product->detail()->orderBy('product_expired')->first()->product_sell_price,
                            0,
                            ',', '.') }} <span class="text-black"> / {{ $item->product->description->unit->unit }}
                            </span>
                        </div>
                        {{-- JUMLAH START --}}
                        <div class="w-[50%] flex justify-end">
                            <div class="w-fit border-1 border-semiBlack border rounded-md flex gap-4 px-2 ">
                                <livewire:cart-counter :cart="$item->cart_id"
                                    :stock="$item->product->detail()->orderBy('product_expired')->first()->product_stock"
                                    :quantity="$item->quantity" />
                            </div>
                        </div>
                        {{-- JUMLAH END --}}
                    </div>
                </div>
            </div>
            @endforeach
        </div>
        @endif
    </div>

    {{-- TOTAL START --}}
    <form action="" method="" class="flex flex-col gap-4">
        <p class="font-bold text-2xl">Total Pesanan</p>
        <hr class="border border-1 border-mediumGrey opacity-20">

        <div class="">
            <div class="flex justify-between text-lg">
                <p class="font-bold text-mediumGrey">Total Barang</p>
                <p class="font-bold ">{{ $totalProducts }} Barang</p>
            </div>

            <div class="flex justify-between text-lg">
                <p class="font-bold text-mediumGrey">Total Harga</p>
                <p class="font-bold text-secondaryColor">Rp. 25.000</p>
            </div>
        </div>

        <button type="submit" class="w-full py-2 bg-mainColor text-white font-bold text-lg rounded-md">Bayar</button>
    </form>
    {{-- TOTAL END --}}
</div>
{{-- CART END --}}