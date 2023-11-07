<div class="flex flex-col items-center mb-8">
    <div class="w-[80vw] mt-8 flex flex-col gap-8 ">
        <p class="font-TripBold text-4xl">Terakhir Dibeli</p>    

        <div class="flex justify-evenly relative">
            <div class="flex flex-wrap justify-center gap-4">
                @for ($i = 0; $i < 5; $i++)
                <div class="h-fit w-[230px] shadow-md border-2 shadow-semiBlack rounded-lg p-4 flex flex-col bg-white">
                    <a href="">
                        <div class="px-2 w-full">
                            <p class="font-semibold text-lg namaObat flex whitespace-normal break-words">Acyclovir 200 mg</p>
                        </div>

                        <center class="relative">
                            <span class="bg-red-500 text-white font-semibold px-2 py-1 text-sm rounded-md absolute top-1 left-2">Resep</span>
                            <img src="{{ asset('img/obat1.jpg/') }}" width="150px" alt="" draggable="false">    
                        </center>
                    </a>

                    <div class="flex justify-between items-center">
                        <div class="px-2 flex flex-col justify-center w-[80%] whitespace-normal break-words">
                            <p><span class="font-TripBold text-secondaryColor">Rp. 250.000.000</span> / kotak</p>
                            <p class="font-semibold">Stok: 900</p>
                        </div>
                        
                        <div class="w-[20%] h-full">
                            <button type="button" class="bg-mainColor h-[40px] w-full rounded-full text-white text-2xl cursor-pointer">+</button>
                        </div>
                    </div>
                </div>
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