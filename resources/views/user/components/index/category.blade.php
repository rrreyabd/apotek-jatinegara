<div class="flex flex-col items-center">
    <div class="w-[70vw] mt-8 flex flex-col gap-8 ">
        <p class="font-TripBold text-4xl">Kategori</p>    

        <div class="flex justify-center">
            <div class="flex flex-wrap justify-center gap-4">
                @foreach ($categories as $category)
                <a href="" class="mb-7 h-72 w-[200px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col text-center gap-4 items-center ">
                    <img src="{{ asset('img/'.$category->category_image) }}" width="150px" draggable="false" alt="">    
                    <p class="font-TripBold text-2xl mt-4">{{ $category->category }}</p>
                </a>
                @endforeach                
{{-- 
                <a href="" class="mb-7 h-72 w-[200px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col text-center gap-4 items-center ">
                    <img src="{{ asset('img/Alergi.png/') }}" width="150px" draggable="false" alt="">    
                    <p class="font-TripBold text-2xl mt-4">Obat Alergi</p>
                </a>

                <a href="" class="mb-7 h-72 w-[200px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col text-center gap-4 items-center ">
                    <img src="{{ asset('img/Asam Urat.png/') }}" width="150px" draggable="false" alt="">    
                    <p class="font-TripBold text-2xl mt-4">Obat Asam Urat</p>
                </a>

                <a href="" class="mb-7 h-72 w-[200px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col text-center gap-4 items-center ">
                    <img src="{{ asset('img/Demam.png/') }}" width="150px" draggable="false" alt="">    
                    <p class="font-TripBold text-2xl mt-4">Obat Demam</p>
                </a>

                <a href="" class="mb-7 h-72 w-[200px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col text-center gap-4 items-center ">
                    <img src="{{ asset('img/Diabetes.png/') }}" width="150px" draggable="false" alt="">    
                    <p class="font-TripBold text-2xl mt-4">Obat Diabetes</p>
                </a>

                <a href="" class="mb-7 h-72 w-[200px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col text-center gap-4 items-center ">
                    <img src="{{ asset('img/Flu&Batuk.png/') }}" width="150px" draggable="false" alt="">    
                    <p class="font-TripBold text-2xl mt-4">Obat Flu & Batuk</p>
                </a>

                <a href="" class="mb-7 h-72 w-[200px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col text-center gap-4 items-center ">
                    <img src="{{ asset('img/Hipertensi.png/') }}" width="150px" draggable="false" alt="">    
                    <p class="font-TripBold text-2xl mt-4">Obat Hipertensi</p>
                </a>

                <a href="" class="mb-7 h-72 w-[200px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col text-center gap-4 items-center ">
                    <img src="{{ asset('img/Kesehatan Wanita.png/') }}" width="150px" draggable="false" alt="">    
                    <p class="font-TripBold text-2xl mt-4">Kesehatan Wanita</p>
                </a>

                <a href="" class="mb-7 h-72 w-[200px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col text-center gap-4 items-center ">
                    <img src="{{ asset('img/bayi.svg/') }}" width="150px" draggable="false" alt="">    
                    <p class="font-TripBold text-2xl mt-4">Kategori Lainnya</p>
                </a> --}}
            </div>
        </div>
    </div>
</div>