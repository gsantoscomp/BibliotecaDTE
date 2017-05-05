<?php

namespace App\Http\Controllers;

use App\Models\User;
//use Illuminate\Http\Request;

class AdmUserController extends Controller
{
    public function index()
    {
        $users = User::all();

        return view('admin.user', [
           'users' => $users
        ]);
    }
}
