<?php

namespace App\Http\Controllers\Admin;

use App\Enums\Role;
use App\Http\Controllers\Controller;
use App\Http\Controllers\FileDoesNotExist;
use App\Http\Controllers\FileIsTooBig;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use App\Http\Requests\UserUpdateRoleRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()->withTrashed();

        if ($request->has('search') && $request->search != '') {
            $searchTerm = '%' . $request->search . '%';

            $users->where(function ($query) use ($searchTerm) {
                $query->where('name', 'like', $searchTerm)
                    ->orWhere('email', 'like', $searchTerm)
                    ->orWhere('role', 'like', $searchTerm);
            });
        }

        $users = $users->orderBy('id', 'asc')->paginate(10);

        return view('pages.admin.user_control', compact('users'));

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
        return view('components.Admin.edit', compact('admin'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $data = $request->validated();

        if ($user->role === Role::ADMIN->value){
            return redirect()->route('admin.index')->withErrors(['message' => 'Вы не можете изменить роль администратора']);
        }
        else {

            if (!empty($data['password'])) {
                $data['password'] = bcrypt($data['password']);
            } else {
                unset($data['password']);
            }

            $user->update($data);
            return redirect()->route('admin.index');
        }
    }


    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.index');
    }

    public function restore($id)
    {
        User::withTrashed()->find($id)->restore();
        return redirect()->route('admin.index');
    }

    public function forceDelete($id)
    {
        User::withTrashed()->find($id)->forceDelete();
        return redirect()->route('admin.index');
    }
}
