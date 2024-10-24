<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreRequest;
use App\Models\Book;


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

    public function store(StoreRequest $request)
    {

        $data = $request->validated();

        Book::create($data);

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
