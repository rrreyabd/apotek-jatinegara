<div class="flex flex-col items-center">
    <div class="w-[80vw] mt-8 flex flex-col gap-8 ">
        <p class="font-TripBold text-4xl">Kategori</p>    

        <div class="flex justify-evenly">
            <div class="flex flex-wrap justify-center gap-4">                
                @for ($i = 0; $i < 9; $i++)
                <a href="" class="mb-4 min-h-64 max-h-fit w-[230px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col text-center gap-4 items-center whitespace-normal break-words">
                    <img src="{{ asset('img/bayi.svg/') }}" width="120px" draggable="false" alt="">    
                    <p class="font-TripBold text-2xl mt-4 w-full">Kategori Lainnya</p>
                </a>
                @endfor
            </div>
        </div>
    </div>
</div>