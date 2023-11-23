<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Masuk</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

</head>
<body class="font-Inter bg-gradient-to-br from-mainColor to-tertiaryColor h-[100vh] flex justify-center items-center">
    
    <form action="/login" method="POST">
        @csrf
        <div class="bg-white w-[80vw] h-[80vh] rounded-3xl shadow-xl flex p-4">
            <div class="w-[55%] flex justify-center items-center">
                <img src="{{ asset('img/login.png/') }}" width="450" alt="" draggable="false">
            </div>
            
            <div class="w-[45%] flex flex-col items-center gap-4 justify-center">
                <p class="font-TripBold text-6xl">Masuk</p>

                @error('loginError')
                    <div class="text-md text-red-500 mt-1 ms-3 mb-0 text-left">
                        {{ $message }}
                    </div>
                @enderror

                @if (session('status') == 'verification-email')
                    <div class="text-sm text-mainColor mt-1 ms-3 mb-0 text-center">
                        {{ __('Link Verifikasi Telah Dikirimkan Ke Email Anda') }}
                    </div>
                @endif
                
                <div class="">
                    <input name="email/username" value="{{ @old('email/username') }}"
                    class="w-[350px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack mt-4"
                    type="text" placeholder="Email/Username">
    
                    @error('email/username')
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
                
                <div class="w-[350px] flex justify-end">
                    <a href="forgot-email" 
                    class="underline text-secondaryColor">Lupa sandi</a>
                </div>

                <button
                class="w-[350px] h-[50px] p-4 m-0 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack bg-secondaryColor font-TripBold text-white flex justify-center items-center text-xl"
                type="submit">Masuk</button>
    
                <p class="p-0 m-0">━━━━━━━━━ Atau ━━━━━━━━━</p>

                <a href="{{ route('auth.goole') }}"
                class="w-[350px] h-[50px] p-4 m-0 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack bg-white font-TripBold flex justify-center items-center text-xl"
                type="submit"><img src="{{ asset('img/Google.png/') }}" alt="" class="w-5 me-3">Masuk Dengan Google</a>

                <div class="flex justify-center items-center flex-col">
                    <p>Belum punya akun?</p>
                    <a href="register" class="underline text-secondaryColor">Daftar disini</a>
                </div>
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
    </script>
</body>
</html>