<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'username' => 'required|min:5|unique:users',
            'name' => 'required',
            'email' => 'required|email:dns|unique:users',
            'password' => 'required|min:5',
            'confirm-password' => 'required|same:password'
        ]);

        $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        $request->session()->flash('success', 'Registration successfull, Please Login');
        return redirect('/register');
    }
}
