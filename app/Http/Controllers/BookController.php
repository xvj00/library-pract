<?php

namespace App\Http\Controllers;


use App\Http\Filters\Book\AuthorFilter;
use App\Http\Filters\Book\EditionFilter;
use App\Http\Filters\Book\GenreFilter;
use App\Http\Requests\BookFilterRequest;
use App\Http\Requests\BookStoreRequest;
use App\Http\Requests\BookUpdateRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Edition;
use App\Models\Genre;
use http\Env\Request;
use Illuminate\Pipeline\Pipeline;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;


class BookController extends Controller
{
    public function index(\Illuminate\Http\Request $request)
    {
        $genres = Genre::all();
        $authors = Author::all();
        $editions = Edition::all();

        // Начинаем с базового запроса к модели Book
        $bookQuery = Book::query();

        if($request->filled('title')){
            $bookQuery->where('title', 'like', '%'.$request->title.'%');
        }

        if ($request->filled('author')) {
            $bookQuery->whereHas('authors', function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->author . '%')
                ->orWhere('surname', 'like', '%' . $request->author . '%');;
            });
        }

        if ($request->filled('genre')) {
            $bookQuery->whereHas('genres', function ($query) use ($request) {
                $query->where('genre_id',$request->genre);
            });
        }

        if ($request->filled('edition')) {
            $bookQuery->where('edition_id', $request->edition);
        }

        // Выполняем запрос с пагинацией
        $books = $bookQuery->paginate(5);

        // Передаем данные в представление
        return view('books.index', compact('books', 'genres', 'authors', 'editions'));

    }

    public function show(Book $book)
    {
        return view('books.show', compact('book'));
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
        return redirect()->route('book.index');
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

        return redirect()->route('book.index');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index');
    }

}
