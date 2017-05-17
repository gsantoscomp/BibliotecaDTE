<?php

namespace App\Http\Controllers;

use App\Models\Notification;
use App\Repositories\NotificationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function store(Request $request)
    {
        $notificationRepository = new NotificationRepository();
        $notification = $notificationRepository->addNotification($request);
        $notificationRepository->changeBookAvailability($request->book_id);

        return new JsonResponse([$notification, 200]);
    }

    public function declineRequest($id)
    {
        $notification = Notification::find($id);

        $notificationRepository = new NotificationRepository();
        $notificationRepository->changeBookAvailability($notification->book_id);
        $notificationRepository->deleteNotification($notification);

        return;
    }

//    public function acceptRequest(Notification $notification)
//    {
//        $today = new \DateTime();
//        $due = new \DateTime();
//        $due->add(new \DateInterval("P14D"));
//        try {
//            //New loan
//            $loan = new Loan();
//            $loan->ln_user_id = $notification->user_id;
//            $loan->ln_bk_id = $notification->book_id;
//            $loan->ln_date = $today;
//            $loan->ln_due_date = $due;
//            $loan->ln_status = 0;
//            //Save
//            $loan->save();
//            //Delete
//            $notification->delete();
//            return new JsonResponse([$loan, 200]);
//        } catch (\Exception $e) {
//            throw $e;
//        }
//
//    }
}
