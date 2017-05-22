<?php

namespace App\Http\Controllers;

use App\Repositories\ClientRepository;
use App\Repositories\LoanRepository;
use Illuminate\Http\Request;
use Auth;
use Cache;

class HomeController extends Controller
{
    public function index()
    {
        $clientRepository = new ClientRepository();
        $loanRepository = new LoanRepository();
        $books = $clientRepository->getAvailableBooks();
        $loanRepository->updateStatus();
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