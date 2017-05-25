<?php

namespace App\Repositories;

use DB;
use Illuminate\Support\Facades\Auth;

class ClientRepository
{
    public function getAvailableBooks()
    {
        $query = DB::table('books')
                    ->where('bk_availability', true)
                    ->paginate(6);

        return $query;
    }

    public function getMyLoans()
    {
        $user = Auth::id();

        $query = DB::table('loans')
                 ->join('books', 'bk_id', 'ln_bk_id')
                 ->where('ln_user_id', $user)
                 ->select('loans.*', 'bk_title')
                 ->get();

        return $query;
    }

    public function getMyNotifications()
    {
        $user = Auth::id();

        $query = DB::table('notifications')
                    ->where('user_id', $user)
                    ->count();

        return $query;
    }

    public function getOverdue()
    {
        $user = Auth::id();

        $query = DB::table('loans')
                    ->where('ln_user_id', $user)
                    ->where('ln_status', 2)
                    ->count();

        return $query;
    }
}