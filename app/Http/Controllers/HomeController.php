<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use Illuminate\Http\Request;
use Auth;
use Cache;

class HomeController extends Controller
{
    public function index()
    {
        $clientRepository = new ClientRepository();
        $books = $clientRepository->getAvailableBooks();

        return view('user.index', [
            'books' => $books
        ]);
    }

}