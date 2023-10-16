<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Daftar</title>
    @vite('resources/css/app.css')

    {{-- FONT AWESOME --}}
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

</head>
<body class="font-Trip bg-gradient-to-br from-mainColor to-tertiaryColor h-[100vh] flex justify-center items-center">
    <form action="">
    <div class="bg-white w-[80vw] h-[80vh] rounded-3xl shadow-xl flex p-4">
            <div class="w-[45%] flex flex-col items-center gap-4 justify-center">
                <p class="font-TripBold text-6xl">Daftar</p>
                
                <input 
                class="w-[350px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack mt-4"
                type="email" placeholder="Email">
                
                <input 
                class="w-[350px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack"
                type="text" placeholder="Username">
                
                <div class="relative">
                    <input id="passwordInput"
                    class="w-[350px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack"
                    type="password" placeholder="Sandi">
                    
                    <button onclick="showPassword()" type="button"
                    class="bg-mainColor absolute rounded-full w-[35px] h-[35px] top-2 right-2
                    flex justify-center items-center">
                        <i class="fa-solid fa-eye text-white" id="toggle"></i>
                    </button>
                </div>

                <div class="relative">
                    <input id="passwordConfirmInput"
                    class="w-[350px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack"
                    type="password" placeholder="Konfirmasi Sandi">
                    
                    <button onclick="showPasswordConfirm()" type="button"
                    class="bg-mainColor absolute rounded-full w-[35px] h-[35px] top-2 right-2
                    flex justify-center items-center">
                        <i class="fa-solid fa-eye text-white" id="toggleConfirm"></i>
                    </button>
                </div>
                
                <button
                class="w-[350px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack bg-secondaryColor font-TripBold text-white flex justify-center items-center text-xl"
                type="submit">Daftar</button>

                <div class="flex justify-center items-center flex-col">
                    <p>Sudah punya akun?</p>
                    <a href="login" class="underline text-secondaryColor">Masuk disini</a>
                </div>
            </div>
            
            <div class="w-[55%] flex justify-center items-center">
                <img src="{{ asset('img/register.png/') }}" width="500" alt="" draggable="false">
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