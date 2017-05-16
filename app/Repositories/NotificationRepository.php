<?php
/**
 * Created by PhpStorm.
 * User: uemanet
 * Date: 16/05/17
 * Time: 15:43
 */

namespace App\Repositories;

use DB;
use App\Models\Book;
use App\Models\Notification;

class NotificationRepository
{
    public function getAdminNotifications()
    {
        $query = DB::table('notifications')
                 ->join('users', 'user_id', 'users.id')
                 ->join('books', 'book_id', 'bk_id')
                 ->where('type', 'request')
                 ->select('users.name as user', 'books.bk_title as book')
                 ->get();

        return $query;
    }

    public function addNotification($request)
    {
        $notification = new Notification();

        $notification->user_id = $request->user;
        $notification->book_id = $request->book;
        $notification->type = $request->type;
        $notification->read = false;

        $notification->save();

        return $notification;
    }

    public function changeBookAvailability($request)
    {
        $book = Book::find($request->book);
        $book->bk_availability = 'indisponivel';

        $book->save();
    }
}