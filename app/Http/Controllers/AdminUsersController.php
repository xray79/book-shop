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
        $this->_updateUser($user);

        session()->flash('success', 'User updated');
        return back();
    }

    protected function _updateUser($user)
    {
        // validate inputs and update user
        $attributes = request()->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => '',
        ]);

        // remove null values
        $attributes = array_filter($attributes);

        // encrypt password
        if (isset($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
        }

        $user->update($attributes);
    }

    public function destroy(User $user)
    {
        $user->delete();
        session()->flash('success', 'User removed');
        return redirect()->back();
    }
}
