<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SessionsController extends Controller
{
    public function create()
    {
        // show the log-in page
        return view('session.create');
    }

    public function store()
    {
        // log-in form POST req handled here

        // validate
        $attributes = request()->validate([
            'email' => 'required|email',
            'password' => 'required|min:3',
        ]);

        // auth()->attempt($attr) tries to log in user if details match, 
        // if false, show a message about wrong user credentials
        if (!auth()->attempt($attributes)) {
            return back()->with('failure', 'E-mail or password not recognised');
        }

        // otherwise user is logged in here
        return redirect('/')->with('success', 'You have been logged in');
    }


    public function edit()
    {
        // show edit form to edit details of current logged in user
        return view('session.show', [
            'user' => Auth::user(),
        ]);
    }

    public function update()
    {
        // send edit form data here
        if ($this->_updateUser(Auth::user())) {
            return back()->with('success', 'User updated');
        }

        return back()->with('failure', 'Could not update');
    }

    protected function _updateUser($user)
    {
        // validate inputs and update user
        $attributes = request()->validate([
            'user-full-name' => 'required',
            'email' => 'required',
            'password' => '',
        ]);

        // remove null values (password is optional)
        $attributes['name'] = $attributes['user-full-name'];
        unset($attributes['user-full-name']);
        $attributes = array_filter($attributes);

        // encrypt password
        if (isset($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
        }

        return $user->update($attributes);
    }

    public function destroy()
    {
        // log out user, redirect to homepage with comfirmation message
        auth()->logout();
        return redirect('/')->with('success', 'You have been logged out');
    }
}
