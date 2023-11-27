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

    <style>
        ::-webkit-scrollbar {
            display: none;
        }
    </style>
</head>
<body class="font-Inter relative h-[100vh]">
    @include('user.components.navbar')

    <div class="flex flex-col items-center mb-16">
        <div class="w-[70vw] mt-8 flex flex-col gap-8">
            <a href="/" class="py-2 flex items-center gap-2">
                <i class="fa-solid fa-arrow-left-long text-secondaryColor"></i>
                <p class="font-semibold text-mediumGrey">Kembali Belanja</p>
            </a>

            <form action="/hapus-akun" method="POST" class="flex justify-between items-center">
                @csrf
                <h1 class="text-2xl font-bold">Pengaturan Akun</h1>
                    <button onclick="deleteAccountFirstValidation()" type="button" class="bg-mediumRed text-white px-4 py-1 font-semibold text-lg rounded-lg">Hapus Akun</button>                

                    {{-- HAPUS AKUN MODAL START --}}
                    <div class="w-full h-full opacity-0 absolute top-0 left-0 backdrop-blur-md z-50 hidden flex justify-center items-center transition duration-300 ease-in-out backdrop-brightness-50" id="deleteAccountModal">
                        <div class="bg-white h-fit w-[30%] rounded-lg shadow-sm shadow-semiBlack py-10 px-8 flex flex-col gap-4 items-center text-center">
                            <i class="text-7xl text-red-600 fa-solid fa-circle-exclamation"></i>
                            <p class="text-2xl font-bold w-[80%]">Apakah Anda yakin ingin menghapus akun Anda?</p>
                            <button onclick="deleteAccountFirstValidation()" type="button" class="bg-secondaryColor px-4 w-52 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack">Batalkan Perubahan</button>
                            <button onclick="deleteAccountSecondValidation()" type="button" class="bg-red-600 w-52 px-4 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack">Lanjutkan</button>
                        </div>
                    </div>
                    {{-- HAPUS AKUN MODAL END --}}

                    {{-- HAPUS AKUN MODAL KEDUA START --}}
                    <div class="w-full h-full opacity-0 absolute top-0 left-0 backdrop-blur-md z-50 hidden flex justify-center items-center transition duration-300 ease-in-out backdrop-brightness-50" id="deleteAccountSecondModal">
                        <div class="bg-white h-fit w-[40%] rounded-lg shadow-sm shadow-semiBlack py-10 px-8 flex flex-col gap-4 items-center text-center">
                            <i class="text-7xl text-red-600 fa-solid fa-circle-exclamation"></i>
                            <p class="text-xl font-medium w-[80%]">Menghapus akun Anda mengakibatkan kehilangan akses ke semua data dan informasi yang terkait dengan akun tersebut.</p>
                            <p class="text-2xl font-bold w-[80%]">Apakah Anda yakin?</p>
                            <button onclick="deleteAccountSecondValidation()" type="button" class="bg-secondaryColor px-4 w-52 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack">Batalkan Perubahan</button>
                            <button type="submit" class="bg-red-600 w-52 px-4 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack" disabled id="btnDeleteAccount">Hapus akun saya</button>
                        </div>
                    </div>
                    {{-- HAPUS AKUN MODAL KEDUA END --}}
                </form>

            <div class="flex justify-between">
                <form action="/user-profile" method="POST"
                class="w-[48%] h-fit px-8 py-4 border-2 rounded-md border-mediumGrey border-opacity-20 flex flex-col items-center gap-4">
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
                        <input type="text" name="username" id="username" value="{{ $username ?? "" }}" placeholder="Username"
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
                        <input type="text" name="nohp" id="nohp" value="{{ $nomorhp ?? "" }}" placeholder="No Handphone"
                        class="border-2 h-12 px-4 rounded-xl bg-lightGrey">
                        @error('nohp')
                            <div class="text-md text-red-500 mt-1 ms-3 mb-0 text-left">
                                {{ $message }}
                            </div>
                        @enderror
                    </div>

                    <div class="flex flex-col w-full gap-2">
                        <label for="email">Email :</label>
                        <input type="text" name="email" id="email" value="{{ $email ?? "" }}" placeholder="Email" disabled
                        class="border-2 h-12 px-4 rounded-xl bg-lightGrey text-slate-500">
                    </div>

                    <button onclick="showDataChangeValidation()" type="button" class="w-fit bg-secondaryColor px-4 py-1 font-semibold text-lg text-white rounded-lg shadow-sm shadow-semiBlack cursor-pointer">Ubah Data</button>

                    {{-- UBAH DATA MODAL START --}}
                    <div class="w-full h-full opacity-0 absolute top-0 left-0 backdrop-blur-md z-50 hidden flex justify-center items-center transition duration-300 ease-in-out backdrop-brightness-50" id="dataChangeModal">
                        <div class="bg-white h-fit w-[30%] rounded-lg shadow-sm shadow-semiBlack py-10 px-8 flex flex-col gap-4 items-center text-center">
                            <i class="text-7xl text-mainColor fa-solid fa-circle-question"></i>
                            <p class="text-2xl font-bold w-[80%]">Apakah Anda yakin ingin mengubah data Anda?</p>
                            <button  onclick="showDataChangeValidation()" type="button" class="bg-mainColor px-4 w-52 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack">Batalkan Perubahan</button>
                            <button type="submit" class="bg-secondaryColor w-52 px-4 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack" disabled id="btnDataChange">Ubah Data Saya</button>
                        </div>
                    </div>
                    {{-- UBAH DATA MODAL END --}}
                </form>

                <form action="/user-profile" method="POST"
                class="w-[48%] h-fit px-8 py-4 border-2 rounded-md border-mediumGrey border-opacity-20 flex flex-col items-center gap-4">
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

                    @if (Hash::check('123', auth()->user()->password))
                    @else
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
                    @endif

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

                    <button onclick="showPassChangeValidation()" type="button" class="w-fit bg-secondaryColor px-4 py-1 font-semibold text-lg text-white rounded-lg shadow-sm shadow-semiBlack">Ubah Sandi</button>

                    {{-- UBAH DATA MODAL START --}}
                    <div class="w-full h-full opacity-0 absolute top-0 left-0 backdrop-blur-md z-50 hidden flex justify-center items-center transition duration-300 ease-in-out backdrop-brightness-50" id="passChangeModal">
                        <div class="bg-white h-fit w-[30%] rounded-lg shadow-sm shadow-semiBlack py-10 px-8 flex flex-col gap-4 items-center text-center">
                            <i class="text-7xl text-mainColor fa-solid fa-circle-question"></i>
                            <p class="text-2xl font-bold w-[80%]">Apakah Anda yakin ingin mengubah sandi Anda?</p>
                            <button onclick="showPassChangeValidation()" type="button" class="bg-mainColor px-4 w-52 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack">Batalkan Perubahan</button>
                            <button type="submit" class="bg-secondaryColor w-52 px-4 py-2 text-white font-bold rounded-md shadow-md shadow-semiBlack" disabled id="btnPasswordChange">Ubah Sandi Saya</button>
                        </div>
                    </div>
                    {{-- UBAH DATA MODAL END --}}
                </form>
            </div>
        </div>
    </div>

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

        const showDataChangeValidation = () => {
            const modal = document.getElementById('dataChangeModal');
            const button = document.getElementById("btnDataChange");
        
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

        const showPassChangeValidation = () => {
            const modal = document.getElementById('passChangeModal');
            const button = document.getElementById("btnPasswordChange");

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

        const deleteAccountFirstValidation = () => {
            const modal = document.getElementById('deleteAccountModal');

            if (modal.classList.contains('hidden')) {
                requestAnimationFrame(() => {
                    modal.classList.remove('hidden');
                    document.body.classList.add('max-h-[100vh]', 'overflow-hidden');
                    requestAnimationFrame(() => {
                        modal.classList.add('opacity-100');
                    });
                });
            } else {
                requestAnimationFrame(() => {
                    modal.classList.remove('opacity-100');
                    document.body.classList.remove('max-h-[100vh]', 'overflow-hidden');
                    requestAnimationFrame(() => {
                        modal.classList.add('hidden');
                    });
                });
            }
        }

        const deleteAccountSecondValidation = () => {
            const previousModal = document.getElementById('deleteAccountModal');

            if (previousModal.classList.contains('hidden') == false) {
                previousModal.classList.add('hidden')
            }

            const modal = document.getElementById('deleteAccountSecondModal');
            const button = document.getElementById("btnDeleteAccount");

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

        
    </script>
</body>
</html>