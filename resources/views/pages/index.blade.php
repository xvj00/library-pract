<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
    <title>Главная</title>
    @vite('resources/css/app.css')
</head>
<body>


<!-- Ваш контент -->
<div class="bg-gray-100">
<!-- Header Section -->
@include('components/header')

<!-- Main Image Section -->
@include('components/main_img')

<!-- News Section -->
<section class="my-10 px-4 md:px-10">
    @include('components/news')
</section>

<!-- Reviews Section -->
<section class="my-10 px-4 md:px-10">
    @include('components/reviews')
</section>

<!-- Footer Section -->
<div>@include('components/footer')</div>
</div>
</body>
</html>
