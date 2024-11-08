<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="../../css/app.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet"/>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
            integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
            integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p"
            crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
            integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF"
            crossorigin="anonymous"></script>
    <title>Books</title>
</head>
<body>
<div class="container my-5 py-4 bg-light rounded shadow-sm text-center">
    <h1 class="display-4 mb-4">Библиотека</h1>

    <div class="d-flex justify-content-center gap-3">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary btn-lg px-5">Профиль</a>

        @if(auth()->user()->role === 'admin')
            <a href="{{ route('admin.index') }}" class="btn btn-outline-danger btn-lg px-5">Админ панель</a>
        @endif

        @if(auth()->user()->role === 'librarian')
            <a href="{{ route('reservations.index') }}" class="btn btn-outline-success btn-lg px-5">Библиотечная панель</a>
        @endif
    </div>
</div>



@yield('content')


</body>
</html>
<style>
    .my-nav svg {
        width: 50px;
        height: 50px;
    }
</style>
