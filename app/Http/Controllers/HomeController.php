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
        $loans = $clientRepository->getMyLoans();
        $openRequests = $clientRepository->getMyNotifications(); //Number of open requests
        $overdue = $clientRepository->getOverdue();

        return view('user.index', [
            'books' => $books,
            'loans' => $loans,
            'openRequests' => $openRequests,
            'overdue' => $overdue
        ]);
    }

}