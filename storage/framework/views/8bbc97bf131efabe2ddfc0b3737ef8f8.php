<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Kasir Apotek | Home</title>
    <?php echo app('Illuminate\Foundation\Vite')('resources/css/app.css'); ?>

    
    <script src="https://kit.fontawesome.com/e87c4faa10.js" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/1fc4ea1c6a.js" crossorigin="anonymous"></script>

</head>
<body class="font-Trip bg-gradient-to-br from-mainColor to-tertiaryColor h-[100vh] flex justify-center items-center">
    <p class="text-4xl">Halaman Kasir</p>

    <form action="/logout" method="POST">
        <?php echo csrf_field(); ?>
        <button class="text-white font-semibold text-lg border-2 flex items-center text-center bg-red-500 h-[35px] px-3 rounded-lg">Logout</button>
    </form>
</body>
</html><?php /**PATH D:\Alwin-Liufandy\School\SEM-3\MSBD\ApotekJatiNegara\apotek-msbd\resources\views/kasir/index.blade.php ENDPATH**/ ?>