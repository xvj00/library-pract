<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::withTrashed()->get();
        return view('admin.index', compact('users'));

    }


    public function create()
    {
        return view('admin.create');
    }

    /**
     * @throws FileIsTooBig
     * @throws FileDoesNotExist
     */
    public function store(UserStoreRequest $request)
    {

        $data = $request->validated();
        User::create($data);


        return redirect()->route('admin.index');
    }

    public function edit(User $admin)
    {
        return view('admin.edit', compact('admin'));
    }

  public function update(UserUpdateRequest $request, User $admin)
   {
       $data = $request->validated();
       $admin->update($data);
       return redirect()->route('admin.index');
   }

    public function destroy(User $admin){
        $admin->delete();
        return redirect()->route('admin.index');
    }

    public function restore($id){
        User::withTrashed()->find($id)->restore();
        return redirect()->route('admin.index');
    }

    public function forceDelete($id){
        User::withTrashed()->find($id)->forceDelete();
        return redirect()->route('admin.index');
    }
}
