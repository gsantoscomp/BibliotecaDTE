<?php

namespace App\Http\Controllers;

use App\Repositories\LoanRepository;
use Illuminate\Http\Request;

class LoanManagementController extends Controller
{
    public function index()
    {
        $loanRepository = new LoanRepository();
        $loans = $loanRepository->getLoan();

        return view('admin.loan',[
            'loans' => $loans
        ]);
    }
}
