<?php

namespace App\Http\Controllers;

use App\Models\Player;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function registration()
    {
        return view('auth.registration');
    }

    public function store(Request $request)
    {
        $existingUser = Player::where('login', $request->login)->orWhere('email', $request->email)->exists();

        if ($existingUser) {
            Session::flash('error', 'User with this login or email already exists.');
            return redirect()->back()->withInput();
        }

        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'login' => 'required|string|max:255|unique:players',
            'email' => 'required|string|email|max:255|unique:players',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            Session::flash('error', 'Filling error. Try again');
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $player = Player::create([
            'name' => $request->input('name'),
            'login' => $request->input('login'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
        ]);

        Session::flash('success', 'Registration successfully completed! Now you can log in');
        return redirect()->back();
    }

    public function login()
    {
        return view('auth.login');
    }

    public function login_store(Request $request)
    {
        if (Auth::attempt(['login' => $request->login, 'password' => $request->password])) {
            return redirect()->route('game');
        } else {
            Session::flash('error', "Incorrect login or password. If you haven't created an account yet, you can create one using the link below.");
            return redirect()->back()->withInput();
        }
    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }
}
