<nav class="shadow-lg h-16 w-full flex justify-center bg-white z-50 fixed" id="navbar">
    <div class="relative w-full flex justify-center">
        <div class="w-full md:w-[95vw] lg:w-[80vw] xl:w-[70vw] h-full flex items-center justify-between relative">
            <a href="/" class="text-mainColor font-TripBold text-3xl">Apotek</a>

            @if (request()->url() == route('home'))
            <livewire:livesearch/>
            @endif

        <div class="flex gap-4 justify-center items-center relative">
            @guest
            <a href="login" class="text-mainColor font-semibold text-lg border-2 flex items-center text-center border-mainColor h-[35px] px-3 rounded-lg">
                Masuk
            </a>

            <a href="register" class="bg-mainColor font-semibold text-lg border-2 flex items-center text-center border-mainColor text-white h-[35px] px-3 rounded-lg">
                Daftar
            </a>
            @else
            {{-- JIKA USER SUDAH LOGIN --}}
                @if (auth()->user()->role == 'user')
                <a href="/keranjang" class="flex justify-center items-center h-[40px] w-[40px] relative">
                    <i class="fa-solid fa-cart-shopping text-3xl text-mainColor"></i>
                    <livewire:cart-notif :count="auth()->user()->cart->count()" />
                </a>

                <button onclick="toggleProfile()"
                    class="border-2 border-mainColor h-[35px] w-[35px] rounded-full flex justify-center items-center overflow-hidden relative">
                    <i class="fa-solid fa-user text-3xl absolute top-1 text-mainColor"></i>
                </button>
                @elseif (auth()->user()->role == 'cashier' || auth()->user()->role == 'owner')
                <a href="/dashboard" class="bg-mainColor text-white flex justify-center items-center h-[40px] w-[100px] rounded-lg relative">
                    Dashboard
                </a>

                <form action="/logout" method="POST" class="bg-red-500 text-white flex justify-center items-center h-[40px] w-[100px] rounded-lg relative">
                    @csrf
                    <button type="submit" class="w-full h-full">Logout</button>
                </form>
                @endif

                {{-- USER DROPDOWN START --}}
                <div class="absolute top-16 right-0 bg-white shadow-md shadow-semiBlack w-64 h-fit rounded-md overflow-hidden cursor-pointer font-medium hidden opacity-0 transition-opacity duration-200 ease-in-out" id="dropdownMenu">   
                    <div class="border border-1 border-b-mediumGrey border-opacity-60 py-2 px-4 flex items-center gap-2">
                        <i class="fa-solid fa-circle-user text-3xl text-mainColor"></i>
                        
                        <div class="flex justify-center flex-col">
                            <p class="font-semibold text-mainColor">{{ Auth()->user()->username }}</p>
                            <p class="text-xs opacity-60">{{ Auth()->user()->email }}</p>
                        </div>
                    </div>

                    <a href="/user-profile" class="flex justify-between px-4 pt-4 pb-2 items-center bg-semiWhite hover:bg-lightGrey duration-300 ease-in-out transition">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-gear"></i>
                            <p>Pengaturan Akun</p>
                        </div>
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>

                    <a href="riwayat" class="flex justify-between px-4 pt-2 pb-4 items-center bg-semiWhite hover:bg-lightGrey duration-300 ease-in-out transition">
                        <div class="flex gap-2 items-center">
                            <i class="fa-solid fa-list"></i>
                            <p>Riwayat Pesanan</p>
                        </div>
                        <i class="fa-solid fa-chevron-right"></i>
                    </a>

                    <div class="flex justify-center items-center bg-red-600 text-white">
                        <button onclick="logoutAlert()" type="button" class="w-full h-full py-2 px-4">Logout</button>
                    </div>
                </div>
                {{-- USER DROPDOWN END --}}
                @endguest   
            </div>
        </div>
        {{-- LOGOUT ALERT START --}}
        <form action="/logout" method="POST" class="w-screen h-screen opacity-0 absolute top-0 backdrop-blur-md z-50 hidden flex justify-center items-center transition duration-300 ease-in-out backdrop-brightness-50" id="logoutAlertPopUp">
            @csrf
            <div class="bg-white h-fit w-[30%] rounded-lg shadow-sm shadow-semiBlack py-10 px-8 flex flex-col gap-4 items-center text-center">
                <i class="text-7xl text-mainColor fa-solid fa-circle-question"></i>
                <p class="text-2xl font-bold w-[80%]">Apakah Anda yakin ingin keluar dari akun Anda?</p>
                <button onclick="logoutAlert()" type="button" class="bg-mainColor px-4 w-52 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack">Kembali</button>
                <button type="submit" class="bg-mediumRed w-52 px-4 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack" disabled id="btnLogout">Keluar</button>
            </div>
        </form>  
        {{-- LOGOUT ALERT END --}}
    </div>
</nav>

{{-- agar position fixed navbar tidak diambil content dibawahnya  --}}
<div class="h-16 w-full"></div>

<script>
    const toggleProfile = () => {
        const menu = document.getElementById('dropdownMenu');

        if (menu.classList.contains('hidden')) {
            requestAnimationFrame(() => {
                menu.classList.remove('hidden');
                requestAnimationFrame(() => {
                    menu.classList.add('opacity-100');
                });
            });
        } else {
            requestAnimationFrame(() => {
                menu.classList.remove('opacity-100');
                requestAnimationFrame(() => {
                    menu.classList.add('hidden');
                });
            });
        }
    }

    const menu = document.querySelector('#dropdownMenu');

    const logoutAlert = () => {
        const modal = document.getElementById('logoutAlertPopUp');
        const button = document.getElementById("btnLogout");

        if (modal.classList.contains('hidden')) {
            button.disabled = false;
            requestAnimationFrame(() => {
                modal.classList.remove('hidden');
                document.body.classList.add('max-h-[100vh]', 'overflow-hidden');
                requestAnimationFrame(() => {
                    modal.classList.add('opacity-100');
                });
            });
        } else {
            button.disabled = true;
            requestAnimationFrame(() => {
                modal.classList.remove('opacity-100');
                document.body.classList.remove('max-h-[100vh]', 'overflow-hidden');
                requestAnimationFrame(() => {
                    modal.classList.add('hidden');
                });
            });
        }
    }

    var input = document.querySelector('#cari');
    var livesearch = document.querySelector('#livesearch')

    document.addEventListener('livewire:init', ()=>{
        input.addEventListener('keydown',  function(){
            var cari = input.value;
            Livewire.dispatch('livesearch', {cari: cari})
        })
    })

    document.addEventListener('click', (event) => {
        if (event.target !== menu) {
            menu.classList.add('hidden');
            menu.classList.remove('opacity-100');
            menu.classList.add('opacity-0');
        }

        if(event.target != input) {
            livesearch.classList.add('hidden');
            livesearch.classList.remove('opacity-100');
            livesearch.classList.add('opacity-0');
        }else{
            livesearch.classList.remove('hidden');
            livesearch.classList.add('opacity-100');
            livesearch.classList.remove('opacity-0');
        }
    });
</script>

{{-- <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<script>    
    $(document).ready(function() {
    $('#cari').autocomplete({
        source: function(request, response) {
            $.ajax({
                url: '{{ route('liveSearch') }}',
                method: 'GET',
                data: {
                    _token: '{{ csrf_token() }}',
                    query: request.term
                },
                dataType: 'json',
                success: function(data) {
                    response(data);
                }
            });
        },
        minLength: 1, // Atur jumlah karakter minimal sebelum live search dimulai
        select: function(event, ui) {
            $('#cari').val(ui.item.product_name); // Menampilkan label destinasi yang dipilih
            $('#product_id').val(ui.item.product_id); // Menyimpan id destinasi yang dipilih pada input tersembunyi
            return false;
        }
    }).data("ui-autocomplete")._renderItem = function(ul, item) {
        return $("<li>")
            .append("<div>" + item.product_name + "</div>")
            .appendTo(ul);
    }.bind(this);
        $('#search-results').on('submit', function() {
        var selectedProductId = $('#product_id').val();
        $('#product_id').val(selectedProductId);
        $('#cari').val($('#cari').val().trim()); // Saring nilai input
    });
});
</script> --}}