<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Repositories\BookRepository;
use App\Repositories\LoanRepository;
use App\Repositories\NotificationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function store(Request $request)
    {
        $notificationRepository = new NotificationRepository();
        $notification = $notificationRepository->addNotification($request);

        $bookRepository = new BookRepository();
        $bookRepository->changeBookAvailability($request->book_id);

        return new JsonResponse([$notification, 200]);
    }

    public function declineRequest($id)
    {
        $notification = Notification::find($id);

        $bookRepository = new BookRepository();
        $bookRepository->changeBookAvailability($notification->book_id);

        $notificationRepository = new NotificationRepository();
        $notificationRepository->deleteNotification($notification);

        return;
    }

    public function acceptRequest($id)
    {
        $notification = Notification::find($id);

        $loanRepository = new LoanRepository();
        $loan = $loanRepository->addLoan($notification); //Add Loan

        $notificationRepository = new NotificationRepository();
        $notificationRepository->deleteNotification($notification);

        return $loan;

    }
}
