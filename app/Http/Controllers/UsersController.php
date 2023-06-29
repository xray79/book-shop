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
        $books = $user->books;

        return view('user.show', [
            'books' => $books,
            'user' => $user,
        ]);
    }

    private function search($books)
    {
        return $books->where('title', 'like', '%' . request('search') . '%')->orWhere('description', 'like', '%' . request('search') . '%');
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

        // format $attributes and encrypt password
        unset($attributes['confirm-password']);
        $attributes['password'] = bcrypt($attributes['password']);

        $user = User::create($attributes);

        auth()->login($user);
        return redirect('/')->with('success', 'Your account has been created');
    }
}
