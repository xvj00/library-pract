<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreRequest;
use App\Models\Book;
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
        return view('books.create');
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function store(StoreRequest $request)
    {

        $data = $request->validated();
        $book = Book::create($data);


        if ($request->hasFile('image')) {
            $book->addMediaFromRequest('image')
                ->toMediaCollection('book_images');
        }
        return redirect()->route('book.index');
    }

    public function edit(Book $book)
    {
        return view('books.edit', compact('book'));
    }

    public function update(StoreRequest $request, Book $book)
    {
        $data = $request->validated();
        $book->update($data);
        return redirect()->route('book.index');
    }

    public function destroy(Book $book)
    {
        $book->delete();
        return redirect()->route('book.index');
    }

}
