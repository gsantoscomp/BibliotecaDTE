<?php

namespace App\Http\Controllers;

use App\Repositories\LoanRepository;
use App\Repositories\NotificationRepository;
use Illuminate\Http\Request;

class LoanManagementController extends Controller
{
    public function index()
    {
        $loanRepository = new LoanRepository();
        $notificationRepository = new NotificationRepository();

        $loans = $loanRepository->getLoan();
        $notifications = $notificationRepository->getAdminNotifications();

        return view('admin.loan',[
            'loans' => $loans,
            'notifications' => $notifications
        ]);
    }
}
