<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Apotek | Lupa Sandi</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>

    
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

</head>
<body class="font-Trip bg-gradient-to-br from-mainColor to-tertiaryColor h-[100vh] flex justify-center items-center">
    <form method="POST" action="<?php echo e(route('password.email')); ?>">
        <?php echo csrf_field(); ?>
        <div class="bg-white w-[35vw] h-[50vh] rounded-3xl shadow-xl flex flex-col justify-center items-center gap-6 px-16 py-4 text-center">
            <p class="font-TripBold text-4xl">Lupa Sandi?</p>
            <p>Masukkan alamat Email Anda ke kolom di bawah. Kami akan mengirim tautan untuk membuat ulang sandi.</p>

            <input name="email"
                class="w-[350px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack mt-4"
                type="text" placeholder="Email">
            <?php $__errorArgs = ['email'];
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

            <?php if(session()->has('status')): ?>
                <div class="text-md text-mainColor mt-1 ms-3 mb-0 text-left">
                    <?php echo e(session('status')); ?>

                </div>
            <?php endif; ?>
            
            <div class="flex gap-2">
                <a href="login"
                class="w-[171px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack text-secondaryColor font-TripBold bg-white flex justify-center items-center text-xl"
                type="submit">Batal</a>

                <button
                class="w-[171px] h-[50px] p-4 rounded-2xl shadow-sm shadow-semiBlack border border-1 border-semiBlack bg-secondaryColor font-TripBold text-white flex justify-center items-center text-xl"
                type="submit">Kirim</button>
            </div>
        </div>
    </form>
</body>
</html><?php /**PATH D:\College\Semester3\MSBD\tubes_apotek_jn\apotek-msbd\resources\views/user/forgot-email.blade.php ENDPATH**/ ?>