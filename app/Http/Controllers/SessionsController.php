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
            session()->flash('success', 'E-mail or password not recognised');
            return redirect()->back();
        }

        // otherwise user is logged in here
        session()->flash('success', 'You have been logged in');
        return redirect('/');
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

        // remove null values (password is optional)
        $attributes = array_filter($attributes);

        // encrypt password
        if (isset($attributes['password'])) {
            $attributes['password'] = bcrypt($attributes['password']);
        }

        $user->update($attributes);
    }

    public function destroy()
    {
        // user gets logged out here
        auth()->logout();
        session()->flash('success', 'You have been logged out');

        return redirect('/');
    }
}
