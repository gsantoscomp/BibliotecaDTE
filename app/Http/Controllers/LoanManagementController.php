<?php

namespace App\Http\Controllers;

use App\Models\Loan;
use App\Repositories\BookRepository;
use App\Repositories\LoanRepository;
use App\Repositories\NotificationRepository;

class LoanManagementController extends Controller
{
    public function index()
    {
        $loanRepository = new LoanRepository();
        $notificationRepository = new NotificationRepository();

        $loans = $loanRepository->getLoan();
        $loanRepository->updateStatus();
        $notifications = $notificationRepository->getAdminNotifications();

        return view('admin.loan',[
            'loans' => $loans,
            'notifications' => $notifications
        ]);
    }

    public function destroy($id)
    {

        $loan = Loan::find($id);

        $bookRepository = new BookRepository();
        $bookRepository->changeBookAvailability($loan->ln_bk_id);

        $loanRepository = new LoanRepository();
        $loanRepository->deleteLoan($id);

        return;
    }
}
