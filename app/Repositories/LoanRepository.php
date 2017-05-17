<?php

namespace App\Repositories;

use App\Models\Book;
use App\Models\Loan;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LoanRepository
{
    public function getLoan()
    {
        $query = DB::table('loans')
            ->join('books', 'bk_id', 'ln_bk_id')
            ->join('users', 'id', 'ln_user_id')
            ->select('loans.*', 'bk_title', 'name')
            ->get();

        return $query;
    }

    public function addLoan($id)
    {
//        $notification = Notification::find($id);
//
//        $today = new \DateTime();
//        $due = new \DateTime();
//        $due->add(new \DateInterval("P14D"));
//
//        //New loan
//        $loan = new Loan();
//        $loan->ln_user_id = $notification->user_id;
//        $loan->ln_bk_id = $notification->book_id;
//        $loan->ln_date = $today;
//        $loan->ln_due_date = $due;
//        $loan->ln_status = 0; //On day
//
//        //Book status
//        $book = Book::findOrFail($notification->book_id);
//        $book->bk_availability = 'indisponivel';
//
//        //Save
//        $book->save();
//        $loan->save();
    }
}