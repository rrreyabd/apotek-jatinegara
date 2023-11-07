<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Profile</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

</head>
<body class="font-Inter relative">
    @include('user.components.secondNavbar')

    <div class="flex flex-col items-center mb-16">
        <div class="w-[70vw] mt-8 flex flex-col gap-8">
            <a href="" class="py-2 flex items-center gap-2">
                <i class="fa-solid fa-arrow-left-long text-secondaryColor"></i>
                <p href="" class="font-semibold text-mediumGrey">Kembali Belanja</p>
            </a>

            <div class="flex justify-between items-center">
                <h1 class="text-2xl font-bold">Pengaturan Akun</h1>
                <button class="bg-mediumRed text-white px-4 py-1 font-semibold text-lg rounded-lg">Hapus Akun</button>                
            </div>

            <div class="flex justify-between">
                <form action="" method=""
                class="w-[48%] h-fit px-8 py-4 border-2 rounded-md border-lightGrey flex flex-col items-center gap-4">
                    <p class="text-xl font-semibold">Profil Pengguna</p>

                    <div class="flex flex-col w-full gap-2">
                        <label for="username">Username :</label>
                        <input type="text" name="name" id="username" value="Raihan Abdillah" placeholder="Username"
                        class="border-2 h-12 px-4 rounded-xl bg-lightGrey">
                    </div>

                    <div class="flex flex-col w-full gap-2">
                        <label for="nohp">No Handphone :</label>
                        <input type="text" name="name" id="nohp" value="081313010909" placeholder="No Handphone"
                        class="border-2 h-12 px-4 rounded-xl bg-lightGrey">
                    </div>

                    <div class="flex flex-col w-full gap-2">
                        <label for="email">Email :</label>
                        <input type="text" name="name" id="email" value="user@gmail.com" placeholder="Email"
                        class="border-2 h-12 px-4 rounded-xl bg-lightGrey">
                    </div>

                    <button type="submit" class="w-48 bg-secondaryColor px-4 py-2 font-semibold text-lg text-white rounded-lg shadow-md shadow-semiBlack">Ubah Data</button>
                </form>

                <form action="" method=""
                class="w-[48%] h-fit px-8 py-4 border-2 rounded-md border-lightGrey flex flex-col items-center gap-4">
                    <p class="text-xl font-semibold">Ubah Kata Sandi</p>

                    <div class="flex flex-col w-full gap-2 relative">
                        <label for="oldPass">Kata Sandi Lama :</label>
                        <input type="password" name="oldPass" id="oldPass" value="123" placeholder="Kata Sandi Lama"
                        class="border-2 h-12 px-4 rounded-xl bg-lightGrey">

                        <button onclick="showPassword()" type="button" class="bg-mainColor absolute rounded-full w-[35px] h-[35px] top-10 right-2 flex justify-center items-center">
                            <i class="fa-solid fa-eye text-white toggleIcon"></i>
                        </button>
                    </div>

                    <div class="flex flex-col w-full gap-2 relative">
                        <label for="newPass">Kata Sandi Baru :</label>
                        <input type="password" name="newPass" id="newPass" value="1234" placeholder="Kata Sandi Baru"
                        class="border-2 h-12 px-4 rounded-xl bg-lightGrey">

                        <button onclick="showPassword()" type="button" class="bg-mainColor absolute rounded-full w-[35px] h-[35px] top-10 right-2 flex justify-center items-center">
                            <i class="fa-solid fa-eye text-white toggleIcon"></i>
                        </button>
                    </div>

                    <div class="flex flex-col w-full gap-2 relative">
                        <label for="confirmNewPass">Konfirmasi Kata Sandi Baru :</label>
                        <input type="password" name="newPass" id="confirmNewPass" value="1234" placeholder="Konfirmasi Kata Sandi Baru"
                        class="border-2 h-12 px-4 rounded-xl bg-lightGrey">

                        <button onclick="showPassword()" type="button" class="bg-mainColor absolute rounded-full w-[35px] h-[35px] top-10 right-2 flex justify-center items-center">
                            <i class="fa-solid fa-eye text-white toggleIcon"></i>
                        </button>
                    </div>

                    <button type="submit" class="w-48 bg-secondaryColor px-4 py-2 font-semibold text-lg text-white rounded-lg shadow-md shadow-semiBlack">Ubah Sandi</button>
                </form>
            </div>
        </div>
    </div>

    @include('user.components.footer')

    <script>
        function showPassword() {
            const inputElement = event.target.previousElementSibling;
            const button = event.target;
            const toggle = button.querySelector('.toggleIcon');

            if (inputElement.type === "password") {
                inputElement.type = "text";
            } else {
                inputElement.type = "password";
            }

            if (toggle.classList.contains('fa-eye')) {
                toggle.classList.remove('fa-eye');
                toggle.classList.add('fa-eye-slash');
            } else {
                toggle.classList.remove('fa-eye-slash');
                toggle.classList.add('fa-eye');
            }
        }
    </script>
</body>
</html>