<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Helpers\Helpers;
use Illuminate\Http\Request;

class UsersController extends Controller
{
    public function show(User $user)
    {
        // show any one user and all of their books
        return view('user.show', [
            'books' => $user->books,
            'user' => $user
        ]);
    }

    public function create()
    {
        // show register page
        return view('user.create');
    }

    public function store()
    {
        // register form details are sent here

        $attributes = request()->validate([
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'password' => 'required|max:255',
            'confirm-password' => 'required|same:password|max:255',
        ]);

        unset($attributes['confirm-password']);
        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        auth()->login($user);
        session()->flash('success', 'Your account has been created');
        return redirect('/');
    }
}
