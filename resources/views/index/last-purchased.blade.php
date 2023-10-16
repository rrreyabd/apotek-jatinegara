{{-- <div class="flex flex-col items-center mb-8">
    <div class="w-[70vw] mt-8 flex flex-col gap-8">
        <p class="font-TripBold text-4xl">Terakhir Dibeli</p>    

        <div class="flex justify-center">
            <div class="flex flex-wrap justify-between">                
                <a href="" class="mx-4 mb-7 h-80 w-[230px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col text-center gap-4 items-center ">
                    <img src="{{ asset('img/obat1.jpg/') }}" width="200px" alt="">    
                    <p class="font-TripBold text-xl mt-4">Acyclovir 200mg <br> 10 Tablet</p>
                </a>

                <a href="" class="mx-4 mb-7 h-80 w-[230px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col text-center gap-4 items-center ">
                    <img src="{{ asset('img/obat1.jpg/') }}" width="200px" alt="">    
                    <p class="font-TripBold text-xl mt-4">Acyclovir 200mg <br> 10 Tablet</p>
                </a>

                <a href="" class="mx-4 mb-7 h-80 w-[230px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col text-center gap-4 items-center ">
                    <img src="{{ asset('img/obat1.jpg/') }}" width="200px" alt="">    
                    <p class="font-TripBold text-xl mt-4">Acyclovir 200mg <br> 10 Tablet</p>
                </a>

                <a href="" class="mx-4 mb-7 h-80 w-[230px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col text-center gap-4 items-center ">
                    <img src="{{ asset('img/obat1.jpg/') }}" width="200px" alt="">    
                    <p class="font-TripBold text-xl mt-4">Acyclovir 200mg <br> 10 Tablet</p>
                </a>
            </div>
        </div>
    </div>
</div> --}}

<div class="flex flex-col items-center">
    <div class="w-[70vw] mt-8 flex flex-col gap-8">
        <p class="font-TripBold text-4xl">Kategori</p>    

        <div class="flex justify-center">
            <div class="flex flex-wrap justify-between">       
                @for ($i = 0; $i < 5; $i++)
                <a href="" class="mx-4 mb-7 h-80 w-[230px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col text-center gap-4 items-center ">
                    <img src="{{ asset('img/Pencernaan.png/') }}" width="200px" alt="">    
                    <p class="font-TripBold text-2xl mt-4">Obat Pencernaan</p>
                </a>
                @endfor         
            </div>
        </div>
    </div>
</div>