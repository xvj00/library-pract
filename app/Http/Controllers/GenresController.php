<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Genre;
use Illuminate\Http\Request;

class GenresController extends Controller
{
    public function create()
    {

        return view('genre.create');
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function store(StoreRequest $request)
    {

        $data = $request->validated();
        $author = Genre::create($data);
        return redirect()->route('book.catalog');

    }
}
