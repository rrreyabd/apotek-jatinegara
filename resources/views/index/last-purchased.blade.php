<div class="flex flex-col items-center mb-8">
    <div class="w-[70vw] mt-8 flex flex-col gap-8">
        <p class="font-TripBold text-4xl">Terakhir Dibeli</p>    

        <div class="flex justify-start">
            <div class="flex flex-wrap justify-between gap-0 lg:gap-[65px]">
                @for ($i = 0; $i < 4; $i++)
                <a href="" class="mb-7 h-72 w-[220px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col bg-white">
                    <div class="px-2">
                        <p class="font-semibold text-lg">Acyclovir</p>
                        <p>200 mg</p>
                    </div>

                    <center>
                        <img src="{{ asset('img/obat1.jpg/') }}" width="150px" alt="" draggable="false">    
                    </center>
                    
                    <div class="flex justify-between items-center">
                        <div class="px-2 flex flex-col justify-center">
                            <p><span class="font-TripBold text-secondaryColor">Rp. 5.000</span> / kotak</p>
                            <p class="font-semibold">Stok: 90</p>
                        </div>

                        <button class="bg-mainColor h-[40px] w-[40px] rounded-full text-white text-2xl">+</button>
                    </div>
                </a>
                @endfor
            </div>
        </div>
    </div>
</div>
