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
<body class="font-Trip bg-gradient-to-br from-mainColor to-tertiaryColor h-[100vh] flex justify-center items-center">
    <form action="">
    <div class="bg-white w-[80vw] h-[80vh] rounded-3xl shadow-xl flex p-4">
            <div class="w-[55%]">
                    
            </div>

            <div class="w-[45%] flex flex-col items-center gap-4 justify-center">
                <p class="font-TripBold text-6xl">Masuk</p>
                
                <input 
                class="w-[350px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack mt-4"
                type="text" placeholder="Email">
                
                <div class="relative">
                    <input 
                    class="w-[350px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack"
                    type="text" placeholder="Sandi">
                    
                    <button class="bg-mainColor absolute rounded-full w-[35px] h-[35px] top-2 right-2
                    flex justify-center items-center">
                        <i class="fa-solid fa-eye text-white"></i>
                    </button>
                </div>
                
                <div class="w-[350px] flex justify-between">
                    <div class="flex gap-2">
                        <input type="checkbox" required>
                        <p>Ingat saya</p>
                    </div>
                    <a href="forgot-email" 
                    class="underline text-secondaryColor">Lupa sandi</a>
                </div>

                <button
                class="w-[350px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack bg-secondaryColor font-TripBold text-white flex justify-center items-center text-xl"
                type="submit">Masuk</button>

                <div class="flex justify-center items-center flex-col">
                    <p>Belum punya akun?</p>
                    <a href="register" class="underline text-secondaryColor">Daftar disini</a>
                </div>
            </div>
        </div>
    </form>
</body>
</html>