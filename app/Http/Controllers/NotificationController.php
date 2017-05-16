<?php

namespace App\Http\Controllers;

use App\Repositories\NotificationRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NotificationController extends Controller
{

    public function index()
    {

    }

    public function store(Request $request)
    {
        $notificationRepository = new NotificationRepository();
        $notification = $notificationRepository->addNotification($request);
        $notificationRepository->changeBookAvailability($request);

        return new JsonResponse([$notification, 200]);
    }
}
