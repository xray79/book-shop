<?php

namespace App\Http\Controllers\Auth;

use App\Helpers\Helpers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AuthAccountController extends Controller
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
            'password' => 'required',
        ]);

        // auth()->attempt($attr) tries to log in user if details match, 
        // if false, show a message about wrong user credentials
        if (!auth()->attempt($attributes)) {
            return back()->with('failure', 'E-mail or password not recognised');
        }

        // otherwise user is logged in here
        return redirect()->intended()->with('success', 'You have been logged in');
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
        $this->_updateUser(Auth::user());
        return back()->with('success', 'User updated');
    }

    protected function _updateUser($user)
    {
        // validate inputs and update user
        $attributes = request()->validate([
            'user-full-name' => 'required',
            'email' => 'required',
            'password' => '',
            'confirm-password' => 'same:password'
        ]);

        // reformat for User model
        $attributes = Helpers::renameAttribute('user-full-name', 'name', $attributes);
        unset($attributes['confirm-password']);
        $attributes = array_filter($attributes);

        // encrypt password
        if (isset($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
        }

        $user->update($attributes);
    }

    public function destroy()
    {
        // log out user, redirect to homepage with message
        auth()->logout();
        return back()->with('success', 'You have been logged out');
    }
}
