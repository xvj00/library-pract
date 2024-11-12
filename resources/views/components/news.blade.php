<div class="main mx-[10%] my-10" id="new-arrivals">
    <div class="container mx-auto px-4">


        <h2 class="text-4xl font-bold text-center mb-8">Новинки</h2>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-10">
            @foreach($books as $book)
                <div
                    class="flex bg-white shadow-lg rounded-lg overflow-hidden hover:shadow-xl transition-shadow duration-300">
                    <!-- Изображение книги -->
                    <div class="w-1/3">
                        <img src="{{ $book->getFirstMediaUrl('book_images') }}"
                             class="w-full h-full object-cover rounded-l-lg" alt="Книга">
                    </div>

                    <!-- Описание книги -->
                    <div class="flex flex-col justify-between p-4 w-2/3">
                        <div>
                            <h3 class="text-xl font-bold text-gray-800 mb-2">{{ $book->title }}</h3>
                            <p class="text-sm text-gray-600 mb-4">
                                @foreach($book->authors as $author)
                                    {{ $author->name }} {{ $author->surname }}
                                @endforeach
                            </p>
                            <!-- Рейтинг -->
                            <div class="flex items-center mb-2">
                                @foreach(range(1, 5) as $index)
                                    <img src="{{ asset('img/star.svg') }}" class="w-5 h-5 mr-1" alt="звезда">
                                @endforeach
                                <span class="text-sm text-gray-500 ml-2">5.0</span>
                            </div>
                        </div>
                        <!-- Кнопка бронирования -->
                        @if((!$book->isReserved()) && (!$book->isConfirmed()) && (!$book->isGiven()))
                            <form action="{{ route('reservations.store', ['book_id' => $book->id]) }}" method="post"
                                  class="d-inline">
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

                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
