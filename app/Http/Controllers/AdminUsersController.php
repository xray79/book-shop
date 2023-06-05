<?php

namespace App\Http\Controllers;

use App\Helpers\Helpers;
use App\Models\User;
use Illuminate\Http\Request;
use Mockery\Undefined;

class AdminUsersController extends Controller
{
    public function index()
    {
        $users = User::latest();

        return view('admin.user.index', ['users' => $users->simplePaginate(10)]);
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', ['user' => $user]);
    }

    public function update(User $user)
    {
        // validate inputs and update user
        $attributes = request()->validate([
            'user-full-name' => 'required',
            'email' => 'required',
            'password' => '',
        ]);

        // format for User model
        $attributes = Helpers::renameAttribute('user-full-name', 'name', $attributes);
        $attributes = array_filter($attributes);

        // encrypt password
        if (isset($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
        }

        $user->update($attributes);

        return back()->with('success', 'User updated');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return back()->with('success', 'User removed');
    }
}
