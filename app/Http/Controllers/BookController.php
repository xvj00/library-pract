<?php

namespace App\Http\Controllers;



use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Edition;
use App\Models\Genre;
use App\Models\Reservation;
use \Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;


class BookController extends Controller
{

    public function showCatalog(Request $request)
    {
        $genres = Genre::all();
        $authors = Author::all();
        $editions = Edition::all();
        $books = Book::query();
        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';

            $books->where(function($query) use ($searchTerm) {
                $query->orWhere('title', 'ilike', $searchTerm)
                    ->orWhereHas('authors', function ($query) use ($searchTerm) {
                        $query->where('name', 'ilike', $searchTerm)->orWhere('surname', 'ilike', $searchTerm);
                    })
                    ->orWhereHas('edition', function ($query) use ($searchTerm) {
                        $query->where('title', 'ilike', $searchTerm);
                    })
                    ->orWhereHas('genres', function ($query) use ($searchTerm) {
                        $query->where('title', 'ilike', $searchTerm);
                    });
            });
        }

        $books = $books->paginate(10);


        return view('pages.catalog', compact(['genres', 'books', 'authors', 'editions']));
    }

    public function index(Request $request)
    {
        $genres = Genre::all();
        $authors = Author::all();
        $editions = Edition::all();
        $reservations = Reservation::all();

        // Начинаем с базового запроса к модели Book
        $bookQuery = Book::query();
//
//        if ($request->filled('title')) {
//            $bookQuery->where('title', 'ilike', '%' . $request->title . '%');
//        }
//
//        if ($request->filled('author')) {
//            $bookQuery->whereHas('authors', function ($query) use ($request) {
//                $query->where('name', 'ilike', '%' . $request->author . '%')
//                    ->orWhere('surname', 'ilike', '%' . $request->author . '%');;
//            });
//        }
//
//        if ($request->filled('genre')) {
//            $bookQuery->whereHas('genres', function ($query) use ($request) {
//                $query->where('genre_id', $request->genre);
//            });
//        }
//
//        if ($request->filled('edition')) {
//            $bookQuery->where('edition_id', $request->edition);
//        }
//
//        if ($request->filled('status')) {
//            $bookQuery->where('status', $request->status);
//        }

        // Выполняем запрос с пагинацией
        $books = $bookQuery->take(4)->get();

        // Передаем данные в представление
        return view('pages.index', compact('books', 'genres', 'authors', 'editions', 'reservations'));

    }



    public function create()
    {
        $genres = Genre::all();
        $authors = Author::all();
        $editions = Edition::all();
        return view('Books.create', compact('authors', 'genres', 'editions'));
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function store(BookStoreRequest $request)
    {

        $data = $request->validated();
        $book = Book::create($data);

        $book->authors()->attach($request->author_id);
        $book->genres()->attach($request->genre_id);

        $book->edition_id = $request->edition_id;
        $book->save();

        if ($request->hasFile('image')) {
            $book->addMediaFromRequest('image')
                ->toMediaCollection('book_images');
        }
        return redirect()->route('book.catalog');
    }

    public function edit(Book $book)
    {
        $genres = Genre::all();
        $authors = Author::all();
        $editions = Edition::all();
        return view('books.edit', compact('authors', 'genres', 'editions', 'book'));
    }

    public function update(BookUpdateRequest $request, Book $book)
    {
        $data = $request->validated();
        $book->update($data);

        // Обновляем связи с авторами
        $book->authors()->sync($request->author_id); // Это обновит отношения, добавляя и удаляя авторов

        // Обновляем связи с жанрами
        $book->genres()->sync($request->genre_id); // Это обновит отношения с жанрами

        if ($request->hasFile('image')) {
            // Удаляем текущее изображение, если оно существует
            if ($book->getFirstMedia('book_images')) {
                $book->clearMediaCollection('book_images');
            }

            // Добавляем новое изображение
            $book->addMediaFromRequest('image')->toMediaCollection('book_images');
        }

        $book->edition_id = $request->edition_id; // Присваиваем новое издание
        $book->save();

        return redirect()->route('book.catalog');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->back();
    }

}
