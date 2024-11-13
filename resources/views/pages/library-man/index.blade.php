@php
    use Illuminate\Support\Carbon;
    use App\Enums\ReservationsStatus
@endphp

    <!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Список бронирований</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

<!-- Header -->
<header class="w-full bg-white ">
    @include('components.header')
</header>

<!-- Main Content -->
<main class="container mx-auto my-8 p-8 bg-white rounded-lg shadow-md">
    <!-- Title -->
    @yield('content')
</main>

</body>
</html>
