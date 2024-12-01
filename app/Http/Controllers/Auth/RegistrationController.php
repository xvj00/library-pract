<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;

class RegistrationController extends Controller
{
    public function create()
    {
        return view('pages.auth.sign_in');
    }

    public function store(RegisterRequest $request)
    {
        $data = $request->validated();
        $user = User::create($data);
        if ($request->hasFile('image')) {
            $user->addMediaFromRequest('image')
                ->toMediaCollection('user_images');
        }

        Auth::login($user);
        event(new Registered($user));
        return redirect()->route('book.index');
    }

}
