<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Каталог</title>
    @vite('resources/css/app.css')
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kalnia:wght@100..700&display=swap" rel="stylesheet">
</head>
<body class="bg-gray-100 text-gray-900">

@include('components/header')

@include('components/main_img')

<main class="main mx-[10%] py-10">
    <div class="container mx-auto px-4">
        <h1 class="text-4xl font-bold mb-8">Каталог</h1>

        <!-- Кнопки для создания элементов -->
        @auth()

            @if( auth()->user()->role === 'librarian' )
                <div class="flex flex-wrap gap-4 mb-8">
                    <a href="{{ route('book.create') }}"
                       class="bg-blue-500 text-white px-6 py-3 rounded-full shadow-lg hover:bg-blue-600 transition-colors duration-200 ease-in-out focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Создать книгу
                    </a>
                    <a href="{{ route('author.create') }}"
                       class="bg-indigo-500 text-white px-6 py-3 rounded-full shadow-lg hover:bg-indigo-600 transition-colors duration-200 ease-in-out focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                        Создать автора
                    </a>
                    <a href="{{ route('genre.create') }}"
                       class="bg-purple-500 text-white px-6 py-3 rounded-full shadow-lg hover:bg-purple-600 transition-colors duration-200 ease-in-out focus:ring-2 focus:ring-offset-2 focus:ring-purple-500">
                        Создать жанр
                    </a>
                    <a href="{{ route('edition.create') }}"
                       class="bg-yellow-500 text-white px-6 py-3 rounded-full shadow-lg hover:bg-yellow-600 transition-colors duration-200 ease-in-out focus:ring-2 focus:ring-offset-2 focus:ring-yellow-500">
                        Создать издание
                    </a>
                </div>
            @endif
        @endauth

        <!-- Форма поиска -->
        <form action="{{ route('book.catalog') }}" method="GET"
              class="search-form mb-8 flex flex-col md:flex-row items-center gap-4 p-6 rounded-lg shadow-md bg-white border border-gray-200">
            <input
                type="text"
                id="search"
                name="search"
                placeholder="Поиск по запросу"
                value="{{ request('search') }}"
                class="w-full md:flex-1 px-6 py-3 rounded-full border border-gray-300 focus:outline-none focus:ring-2 focus:ring-green-500 text-gray-700 shadow-sm transition-all duration-200 ease-in-out hover:shadow-md"
            >
            <div class="flex gap-4">
                <button type="submit"
                        class="bg-green-500 text-white px-6 py-3 rounded-full shadow-lg hover:bg-green-600 transition-colors duration-200 ease-in-out focus:ring-2 focus:ring-offset-2 focus:ring-green-500">
                    Поиск
                </button>
                @if(request()->has('search'))
                    <a href="{{ route('book.catalog') }}"
                       class="bg-gray-300 text-gray-700 px-6 py-3 rounded-full shadow-lg hover:bg-gray-400 transition-colors duration-200 ease-in-out focus:ring-2 focus:ring-offset-2 focus:ring-gray-300">
                        Сбросить фильтр
                    </a>
                @endif
            </div>
        </form>

        <!-- Цикл по книгам -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 w-full my-[5%]">
            @foreach($books as $book)
                <div class="flex flex-col md:flex-row-reverse bg-white rounded-lg shadow-md overflow-hidden border border-gray-200">
                    <!-- Изображение книги -->
                    <div class="w-full p-4 flex justify-center md:w-1/3 md:order-1">
                        <img src="{{ $book->getFirstMediaUrl('book_images') }}"
                             class="max-w-[300px] max-h-[400px] w-full h-auto object-cover"
                             alt="Книга">
                    </div>

                    <!-- Информация о книге -->
                    <div class="flex flex-col justify-between p-4 w-full md:w-2/3">
                        <div class="flex flex-col">
                            <h2 class="text-xl font-semibold text-gray-800 mb-2">{{ $book->title }}</h2>
                            <p class="text-sm text-gray-600 mb-1">Автор:
                                @foreach($book->authors as $author)
                                    {{ $author->name }} {{ $author->surname }}
                                @endforeach
                            </p>
                            <p class="text-sm text-gray-600 mb-1">Издание: {{ $book->edition->title }}</p>
                            <p class="text-sm text-gray-600 mb-1">
                                Жанры: {{ $book->genres->pluck('title')->implode(', ') }}</p>
                            <p class="text-sm text-gray-600 mb-1">Описание: {{ $book->description }}</p>
                        </div>
                        <div class="flex items-center mt-3 mb-4">
                            <span class="text-sm text-gray-500 mr-2">Рейтинг:</span>
                            <div class="flex">
                                @foreach(range(1, 5) as $index)
                                    <img src="{{ asset('img/star.svg') }}" class="w-5 h-5 mr-1" alt="звезда">
                                @endforeach
                            </div>
                        </div>
                        @if((!$book->isReserved()) && (!$book->isConfirmed()) && (!$book->isGiven()))
                            <form action="{{ route('reservations.store', ['book_id' => $book->id]) }}" method="post" class="d-inline">
                                @csrf
                                <button type="submit"
                                        class="w-full py-2 bg-green-500 text-white rounded-md shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-400 transition">
                                    <b>Забронировать</b>
                                </button>
                            </form>
                        @elseif($book->isGiven())
                            <button class="w-full py-2 bg-gray-500 text-white rounded-md shadow-md cursor-not-allowed"
                                    disabled>
                                <b>Книги нет в наличии</b>
                            </button>
                        @else
                            <button class="w-full py-2 bg-gray-300 text-white rounded-md shadow-md cursor-not-allowed"
                                    disabled>
                                <b>Забронировано</b>
                            </button>
                        @endif

                        @auth()
                            @if( auth()->user()->role === 'librarian' )
                                <!-- Кнопки для редактирования и удаления книги -->
                                <div class="mt-4 flex gap-4">
                                    <a href="{{ route('book.edit', $book->id) }}"
                                       class="bg-blue-500 text-white px-4 py-2 rounded-full shadow-md hover:bg-blue-600 focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                        Изменить
                                    </a>

                                    <form action="{{ route('book.destroy', $book->id) }}" method="POST"
                                          onsubmit="return confirm('Вы уверены, что хотите удалить эту книгу?');">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit"
                                                class="bg-red-500 text-white px-4 py-2 rounded-full shadow-md hover:bg-red-600 focus:ring-2 focus:ring-offset-2 focus:ring-red-500">
                                            Удалить
                                        </button>
                                    </form>
                                </div>
                            @endif
                        @endauth
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-6">
            <nav aria-label="Page navigation">
                <ul class="flex justify-center space-x-2">
                    @if ($books->onFirstPage())
                        <li>
                    <span
                        class="inline-block py-2 px-4 text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed">
                        &laquo; Назад
                    </span>
                        </li>
                    @else
                        <li>
                            <a href="{{ $books->previousPageUrl() }}"
                               class="inline-block py-2 px-4 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                &laquo; Назад
                            </a>
                        </li>
                    @endif

                    @foreach ($books->getUrlRange(1, $books->lastPage()) as $page => $url)
                        <li>

                            <a href="{{ $url }}"
                               class="inline-block py-2 px-4 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500
                       {{ $page == $books->currentPage() ? 'bg-blue-600 border-blue-600' : '' }}">
                                {{ $page }}
                            </a>
                        </li>
                    @endforeach

                    @if ($books->hasMorePages())
                        <li>
                            <a href="{{ $books->nextPageUrl() }}"
                               class="inline-block py-2 px-4 text-gray-700 bg-white border border-gray-300 rounded-lg hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500">
                                Далее &raquo;
                            </a>
                        </li>
                    @else
                        <li>
                    <span
                        class="inline-block py-2 px-4 text-gray-400 bg-white border border-gray-300 rounded-lg cursor-not-allowed">
                        Далее &raquo;
                    </span>
                        </li>
                    @endif
                </ul>
            </nav>
        </div>


    </div>
</main>

@include('components/footer')

</body>
</html>
