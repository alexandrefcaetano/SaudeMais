<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


class LoginController extends Controller
{
    public function index()
    {
        return view('login');
    }
    public function store(Request $request)
    {
        $request->validate([
            'login'=>'required',
            'password'=>'required|min:8'
        ],[
            'login.required'=>'Campo Obrigatorio',
            'password.required'=>'Campo Obrigatorio',
            'password.min'=>'Esta Campo deve conter no minimo 8 caracteres'
        ]);


    }
    public function destroy()
    {

    }
}
