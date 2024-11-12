<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Корзина</title>
    @vite('resources/css/app.css')

</head>
<body id="app">
<header class="w-full">
        <div class="border-b-2 border-green px-[3%]">
            <div class="header flex justify-between">
                <div>
                    @include('components/nav-menu')
                </div>
                <div class="flex items-center w-full5" id="cart">
                    <div>
                        <btn-cross></btn-cross>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <main class="main">
        <p class="text64_36 mx-[5%]"> Моя корзина</p>
        <div class="w-4/5 m-auto grid grid-cols-[70%_30%] my-[5%]">
            <div class="flex h-2/3">
                <img src="{{asset('img/book.png')}}" class="h-full" alt="Книга">
                <div class="flex flex-col mx-[5%]">
                    <b class="text36_14">Зеленая миля</b>
                    <b class="text24_12 text-green">Стивен Кинг</b>
                </div>
            </div>
            <div class="w-full justify-center flex">
                <form action="" class="w-full">
                    <button class="btn-green btn_green_h40 text20_10 px-[10%]">Убрать бронь</button>
                </form>
            </div>
        </div>
    </main>
    @include('components/footer')

</body>
</html>