<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Управление библиотекой</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
</head>
<body id="app">
<header class="w-full">
        <div class="border-b-2 border-green px-[3%]">
            <div class="header flex justify-between">
                <div>
                    @include('components/nav-menu')
                </div>
            </div>
        </div>
    </header>
    @include('components/main_img')

    <main class="main mx-[10%]">
        <p class="text64_36">Управление библиотекой</p>
        <div class="my-[2%]">
            <b class="text36_14">Добавление книги</b>
            <div class="flex">  
                <form action="" method="post" class="grid grid-cols-4 gap-[5%] w-full">
                @csrf

                    @foreach ($fields as $field)
                        <div class="my-[10%]">
                            <p class="text20_10">{{ $field['label'] }}</p>
                            <input type="text" name="{{ $field['name'] }}" class="input_admin_user input_searth_h70">
                        </div>
                    @endforeach

                    <button type="submit" class="btn-green text32_12  p-[3%]">Добавить</button>
                </form>
            </div>
            <div class="grid grid-cols-2">
                <div class="my-[5%]"> 
                    <b class="text36_14">Удаление книги</b>
                    <div class="flex">  
                        <form action="" method="post" class="flex  flex-col w-1/2">
                        @csrf
                                <div class="my-[10%]">
                                    <p class="text20_10">Поиск книги</p>
                                    <input type="text" name="{{ $field['name'] }}" class="input_admin_user input_searth_h70">
                                </div>
                            <button type="submit" class="btn-green  text32_12 p-[3%]">Удалить</button>
                        </form>
                    </div>
                </div>
                <div class="my-[5%]"> 
                    <b class="text36_14">Снять бронь</b>
                    <div class="flex">  
                        <form action="" method="post" class="flex  flex-col w-1/2">
                        @csrf
                                <div class="my-[10%]">
                                    <p class="text20_10">Поиск книги</p>
                                    <input type="text" name="{{ $field['name'] }}" class="input_admin_user input_searth_h70">
                                </div>
                            <button type="submit" class="btn-green  text32_12 p-[3%]">Снять</button>
                        </form>
                    </div>
                </div>
            </div>
          
        </div>
    </main>
    @include('components/footer')

</body>
</html>