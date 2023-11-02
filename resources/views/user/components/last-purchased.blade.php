<div class="flex flex-col items-center mb-8">
    <div class="w-[70vw] mt-8 flex flex-col gap-8">
        <p class="font-TripBold text-4xl">Terakhir Dibeli</p>    

        <div class="flex justify-start">
            <div class="flex flex-wrap justify-between gap-0 lg:gap-[65px]">
                @for ($i = 0; $i < 4; $i++)
                <a href="" class="mb-7 h-64 w-[220px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col bg-white">
                    {{-- <div class="flex justify-start mb-2">
                        <span class="bg-red-500 text-white font-semibold px-2 py-1 text-sm rounded-md">Resep</span>
                    </div> --}}

                    <div class="px-2">
                        <p class="font-semibold text-lg namaObat">Acyclovir 200 mg</p>
                    </div>

                    <center class="relative">
                        <span class="bg-red-500 text-white font-semibold px-2 py-1 text-sm rounded-md absolute top-1 left-2">Resep</span>
                        <img src="{{ asset('img/obat1.jpg/') }}" width="150px" alt="" draggable="false">    
                    </center>
                    
                    <div class="flex justify-between items-center">
                        <div class="px-2 flex flex-col justify-center">
                            <p><span class="font-TripBold text-secondaryColor">Rp. 5.000</span> / kotak</p>
                            <p class="font-semibold">Stok: 90</p>
                        </div>

                        <button class="bg-mainColor h-[40px] w-[40px] rounded-full text-white text-2xl">+</button>
                    </div>

                    {{-- <div class="px-2">
                        <span class="bg-red-500 text-white font-semibold px-2 py-1 text-sm rounded-md">Resep</span>
                    </div> --}}
                </a>
                @endfor
            </div>
        </div>
    </div>
</div>

<script>
    const obatElements = document.getElementsByClassName("namaObat");

    for (let i = 0; i < obatElements.length; i++) {
    const obatText = obatElements[i].textContent;

    if (obatText.length > 20) {
        obatElements[i].textContent = obatText.slice(0, 18) + "...";
    }
    }
</script>