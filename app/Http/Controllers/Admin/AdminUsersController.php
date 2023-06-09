<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Mockery\Undefined;
use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class AdminUsersController extends Controller
{
    public function index()
    {
        // get all users
        $users = User::latest();

        // update $users based on search query
        if (request('search')) {
            $users = $this->_search($users);
        }

        return view('admin.user.index', [
            'users' => $users->simplePaginate(10)
        ]);
    }

    protected function _search($users)
    {
        return $users->where('name', 'like', '%' . request('search') . '%')
            ->orWhere('email', 'like', '%' . request('search') . '%');
    }

    public function edit(User $user)
    {
        // show view to edit user
        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    public function update(User $user)
    {
        // validate inputs and update user
        $attributes = request()->validate([
            'user-full-name' => 'required',
            'email' => 'required',
            'password' => '',
            'confirm-password' => 'same:password',
        ]);

        // format $attributes for User model
        // rename attributes and delete any empty attributes
        $attributes = Helpers::renameAttribute('user-full-name', 'name', $attributes);
        unset($attributes['confirm-password']);
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
