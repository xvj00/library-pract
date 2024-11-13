<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreRequest;
use App\Models\Edition;
use Illuminate\Http\Request;

class EditionController extends Controller
{
    public function create()
    {

        return view('edition.create');
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function store(StoreRequest $request)
    {

        $data = $request->validated();
        $author = Edition::create($data);
        return redirect()->route('book.catalog');

    }
}
