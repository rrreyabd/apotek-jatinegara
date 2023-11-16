<div>
    <div class="relative inline-block text-left">
        <button id="dropdown-button1" class="inline-flex justify-center gap-2 items-center w-full px-4 py-2 text-sm font-medium text-gray-700 bg-white border border-gray-300 rounded-md shadow-md focus:outline-none focus:ring-2  focus:ring-mainColor">
            Bentuk Obat
            <i class="fa-solid fa-chevron-down"></i>
        </button>
        <div id="dropdown-menu1" class="origin-top-right absolute left-0 mt-2 w-48 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5">
            <div class="py-2 p-2" role="menu" aria-orientation="vertical" aria-labelledby="dropdown-button">

                @for ($j = 1; $j < 5; $j++)
                <form action="" method="GET">
                    @csrf
                    <input type="hidden" name="" id="" value="">
                    <button class="flex rounded-md px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 active:bg-blue-100 cursor-pointer" role="menuitem">
                        Option {{$j}}
                    </button>
                </form>
                @endfor

            </div>
        </div>
    </div>
</div>
