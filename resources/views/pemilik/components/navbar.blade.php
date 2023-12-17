<div class="flex justify-between">
    <div class="sm:flex gap-8">
        {{-- toggle --}}
        <button onclick="sidebar()" class="p-3 px-4 rounded-lg shadow-md bg-white w-fit" style="transition: 0.25s;" id="buttonToggle">
            <i class="fa-solid fa-bars" id="toggle"></i>
        </button>
    </div>
</div>

<script>
    const sidebar = () => {
        const sidebar = document.getElementById('sidebar');
        const main = document.getElementById('mainContent');

        if (sidebar.classList.contains('-translate-x-96')) {
            sidebar.classList.remove('-translate-x-96')
            main.classList.add('brightness-50')
            // document.body.classList.add('h-[100vh]')
            // document.body.classList.add('overflow-hidden')
        } else {
            sidebar.classList.add('-translate-x-96')
            main.classList.remove('brightness-50')
            // document.body.classList.remove('h-[100vh]')
            // document.body.classList.remove('overflow-hidden')
        }

    }
</script>