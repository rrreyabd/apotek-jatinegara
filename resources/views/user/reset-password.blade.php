<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Reset Password</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

</head>
<body class="font-Trip bg-gradient-to-br from-mainColor to-tertiaryColor h-[100vh] flex justify-center items-center">
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">

        <div class="bg-white w-[50vw] h-[75vh] rounded-3xl shadow-xl flex flex-col justify-center items-center gap-6 px-16 py-4 text-center">
            <p class="font-TripBold text-4xl">Ubah Sandi</p>
            <p class="text-sm">Pastikan Anda memilih sandi baru yang mudah untuk anda ingat.</p>

            <div class="">
                <input name="email" value="{{ $request->email }}"
                    class="w-[350px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack mt-4"
                    type="text" placeholder="Email">
                @error('email')
                    <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="relative">
                <input id="passwordInput" name="password"
                class="w-[350px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack"
                type="password" placeholder="Sandi">
                
                <button onclick="showPassword()" type="button"
                class="bg-mainColor absolute rounded-full w-[35px] h-[35px] top-2 right-2
                flex justify-center items-center">
                    <i class="fa-solid fa-eye text-white" id="toggle"></i>
                </button>
                @error('password')
                    <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                        {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="relative">
                <input id="passwordConfirmInput" name="password_confirmation"
                class="w-[350px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack"
                type="password" placeholder="Konfirmasi Sandi">
                
                <button onclick="showPasswordConfirm()" type="button"
                class="bg-mainColor absolute rounded-full w-[35px] h-[35px] top-2 right-2
                flex justify-center items-center">
                    <i class="fa-solid fa-eye text-white" id="toggleConfirm"></i>
                </button>
                @error('password_confirmation')
                    <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                        {{ $message }}
                    </div>
                @enderror
            </div>
            
            <div class="flex gap-2">
                <button
                class="w-[260px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack bg-secondaryColor font-TripBold text-white flex justify-center items-center text-xl"
                type="submit">Reset Password</button>
            </div>
        </div>
    </form>

    <script>
        function showPassword() {
            const toggle = document.getElementById('toggle');
            const passwordInput = document.getElementById('passwordInput');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
            }

            if (toggle.classList.contains('fa-eye')) {
                toggle.classList.remove('fa-eye');
                toggle.classList.add('fa-eye-slash');
            } else {
                toggle.classList.remove('fa-eye-slash');
                toggle.classList.add('fa-eye');
            }
        }

        function showPasswordConfirm() {
            const toggle = document.getElementById('toggleConfirm');
            const passwordInput = document.getElementById('passwordConfirmInput');

            if (passwordInput.type === "password") {
                passwordInput.type = "text";
            } else {
                passwordInput.type = "password";
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