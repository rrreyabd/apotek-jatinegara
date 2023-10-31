<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Masuk</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>

    
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

</head>
<body class="font-Trip bg-gradient-to-br from-mainColor to-tertiaryColor h-[100vh] flex justify-center items-center">
    
    <form action="/login" method="POST">
        <?php echo csrf_field(); ?>
        <div class="bg-white w-[80vw] h-[80vh] rounded-3xl shadow-xl flex p-4">
            <div class="w-[55%] flex justify-center items-center">
                <img src="<?php echo e(asset('img/login.png/')); ?>" width="500" alt="" draggable="false">
            </div>
            
            <div class="w-[45%] flex flex-col items-center gap-4 justify-center">
                <p class="font-TripBold text-6xl">Masuk</p>

                <?php if(session('status') == 'verification-email'): ?>
                    <div class="text-sm text-mainColor mt-1 ms-3 mb-0 text-center">
                        <?php echo e(__('Link Verifikasi Telah Dikirimkan Ke Email Anda')); ?>

                    </div>
                <?php endif; ?>
                
                <div class="">
                    <input name="email/username" value="<?php echo e(@old('email/username')); ?>"
                    class="w-[350px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack mt-4"
                    type="text" placeholder="Email/Username">
    
                    <?php $__errorArgs = ['email/username'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
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
                    <?php $__errorArgs = ['password'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                        <div class="text-sm text-red-500 mt-1 ms-3 mb-0 text-left">
                            <?php echo e($message); ?>

                        </div>
                    <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>
                </div>
                
                <div class="w-[350px] flex justify-end">
                    <a href="forgot-email" 
                    class="underline text-secondaryColor">Lupa sandi</a>
                </div>
                
                <?php $__errorArgs = ['loginError'];
$__bag = $errors->getBag($__errorArgs[1] ?? 'default');
if ($__bag->has($__errorArgs[0])) :
if (isset($message)) { $__messageOriginal = $message; }
$message = $__bag->first($__errorArgs[0]); ?>
                    <div class="text-md text-red-500 mt-1 ms-3 mb-0 text-left">
                        <?php echo e($message); ?>

                    </div>
                <?php unset($message);
if (isset($__messageOriginal)) { $message = $__messageOriginal; }
endif;
unset($__errorArgs, $__bag); ?>

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
</html><?php /**PATH D:\College\Semester3\MSBD\tubes_apotek_jn\apotek-msbd\resources\views/user/login.blade.php ENDPATH**/ ?>