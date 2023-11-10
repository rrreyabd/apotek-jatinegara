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
            <a href="/" class="py-2 flex items-center gap-2">
                <i class="fa-solid fa-arrow-left-long text-secondaryColor"></i>
                <p class="font-semibold text-mediumGrey">Kembali Belanja</p>
            </a>

            <form action="/hapus-akun" method="POST" class="flex justify-between items-center">
                @csrf
                <h1 class="text-2xl font-bold">Pengaturan Akun</h1>
                <button class="bg-mediumRed text-white px-4 py-1 font-semibold text-lg rounded-lg">Hapus Akun</button>                
            </form>

            <div class="flex justify-between">
                <form action="/user-profile" method="POST"
                class="w-[48%] h-fit px-8 py-4 border-2 rounded-md border-lightGrey flex flex-col items-center gap-4">
                @csrf
                    <input type="hidden" name="update" value="profile">
                    <p class="text-xl font-semibold">Profil Pengguna</p>

                    @if (session()->has('success_profile'))
                        <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <p class="text-sm text-mainColor p-0 m-0 text-center">{{ session('success_profile') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="flex flex-col w-full gap-2">
                        <label for="username">Username :</label>
                        <input type="text" name="username" id="username" value="{{ $username }}" placeholder="Username"
                        class="border-2 h-12 px-4 rounded-xl bg-lightGrey">
                        @error('username')
                        @if ($message == 'The username field format is invalid.')
                            <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                                The username field must not contain spaces (" ").
                            </div>
                        @else
                            <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                                {{ $message }}
                            </div>
                        @endif
                        @enderror
                    </div>

                    <div class="flex flex-col w-full gap-2">
                        <label for="nohp">No Handphone :</label>
                        <input type="text" name="nohp" id="nohp" value="{{ $nomorhp }}" placeholder="No Handphone"
                        class="border-2 h-12 px-4 rounded-xl bg-lightGrey">
                        @error('nohp')
                            <div class="text-md text-red-500 mt-1 ms-3 mb-0 text-left">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full gap-2">
                        <label for="email">Email :</label>
                        <input type="text" name="email" id="email" value="{{ $email }}" placeholder="Email" disabled
                        class="border-2 h-12 px-4 rounded-xl bg-lightGrey text-slate-500">
                    </div>

                    <button type="submit" class="w-48 bg-secondaryColor px-4 py-2 font-semibold text-lg text-white rounded-lg shadow-md shadow-semiBlack">Ubah Data</button>
                </form>

                <form action="/user-profile" method="POST"
                class="w-[48%] h-fit px-8 py-4 border-2 rounded-md border-lightGrey flex flex-col items-center gap-4">
                    @csrf
                    <input type="hidden" name="update" value="password">
                    <p class="text-xl font-semibold">Ubah Kata Sandi</p>

                    @if (session()->has('success_password'))
                        <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <p class="text-sm text-mainColor p-0 m-0 text-center">{{ session('success_password') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if (session()->has('error'))
                        <div class="alert alert-dark alert-dismissible fade show" role="alert">
                            <p class="text-sm text-red-500 p-0 m-0 text-center">{{ session('error') }}</p>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="flex flex-col w-full gap-2 relative">
                        <label for="password_lama">Kata Sandi Lama :</label>
                        <input type="password" name="password_lama" id="password_lama" value="" placeholder="Kata Sandi Lama"
                        class="border-2 h-12 px-4 rounded-xl bg-lightGrey">

                        <button onclick="showPassword()" type="button" class="bg-mainColor absolute rounded-full w-[35px] h-[35px] top-10 right-2 flex justify-center items-center">
                            <i class="fa-solid fa-eye text-white toggleIcon"></i>
                        </button>
                        @error('password_lama')
                            @if ($message == 'The password lama field format is invalid.')
                                <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                                    The password lama field must not contain spaces (" ").
                                </div>
                            @else
                                <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                                    {{ $message }}
                                </div>
                            @endif
                        @enderror
                    </div>

                    <div class="flex flex-col w-full gap-2 relative">
                        <label for="password_baru">Kata Sandi Baru :</label>
                        <input type="password" name="password_baru" id="password_baru" value="" placeholder="Kata Sandi Baru"
                        class="border-2 h-12 px-4 rounded-xl bg-lightGrey">

                        <button onclick="showPassword()" type="button" class="bg-mainColor absolute rounded-full w-[35px] h-[35px] top-10 right-2 flex justify-center items-center">
                            <i class="fa-solid fa-eye text-white toggleIcon"></i>
                        </button>
                        @error('password_baru')
                            @if ($message == 'The password baru field format is invalid.')
                                <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                                    The password baru field must not contain spaces (" ").
                                </div>
                            @else
                                <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                                    {{ $message }}
                                </div>
                            @endif
                        @enderror
                    </div>

                    <div class="flex flex-col w-full gap-2 relative">
                        <label for="konfirmasi_password_baru">Konfirmasi Kata Sandi Baru :</label>
                        <input type="password" name="konfirmasi_password_baru" id="konfirmasi_password_baru" value="" placeholder="Konfirmasi Kata Sandi Baru"
                        class="border-2 h-12 px-4 rounded-xl bg-lightGrey">

                        <button onclick="showPassword()" type="button" class="bg-mainColor absolute rounded-full w-[35px] h-[35px] top-10 right-2 flex justify-center items-center">
                            <i class="fa-solid fa-eye text-white toggleIcon"></i>
                        </button>
                        @error('konfirmasi_password_baru')
                        @if ($message == 'The konfirmasi password baru field format is invalid.')
                            <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                                The konfirmasi password baru field must not contain spaces (" ").
                            </div>
                        @else
                            <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                                {{ $message }}
                            </div>
                        @endif
                        @enderror
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