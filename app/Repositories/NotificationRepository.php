<?php
/**
 * Created by PhpStorm.
 * User: uemanet
 * Date: 16/05/17
 * Time: 15:43
 */

namespace App\Repositories;

use DB;
use App\Models\Notification;

class NotificationRepository
{
    public function getAdminNotifications()
    {
        $query = DB::table('notifications')
                 ->join('users', 'user_id', 'users.id')
                 ->join('books', 'book_id', 'bk_id')
                 ->where('type', 'request')
                 ->select('notifications.id as id', 'users.name as user', 'books.bk_title as book')
                 ->get();

        return $query;
    }

    public function addNotification($request)
    {
        $notification = new Notification();

        $notification->user_id = $request->user_id;
        $notification->book_id = $request->book_id;
        $notification->type = $request->type;
        $notification->read = false;

        $notification->save();

        return $notification;
    }

    public function deleteNotification($request)
    {
        $query = DB::table('notifications')
                ->where('id', $request->id)
                ->delete();

        return $query;
    }
}