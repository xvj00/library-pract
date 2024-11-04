<?php

namespace App\Http\Controllers;


use App\Http\Requests\BookUpdateRequest;
use App\Http\Requests\BookStoreRequest;
use App\Models\Author;
use App\Models\Book;
use App\Models\Edition;
use App\Models\Genre;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileDoesNotExist;
use Spatie\MediaLibrary\MediaCollections\Exceptions\FileIsTooBig;


class BookController extends Controller
{
    public function index()
    {

        $books = Book::query()->paginate(5);
        return view('books.index', compact('books'));

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
