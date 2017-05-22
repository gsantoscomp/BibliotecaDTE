<?php

namespace App\Repositories;

use App\Models\Loan;
use DB;

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

    public function addLoan($notification)
    {
        $loan = new Loan();
        $today = new \DateTime();
        $due = new \DateTime();
        $due->add(new \DateInterval("P14D"));

        $loan->ln_user_id = $notification->user_id;
        $loan->ln_bk_id = $notification->book_id;
        $loan->ln_date = $today;
        $loan->ln_due_date = $due;
        $loan->ln_status = 0; //On day

        $loan->save();

        return $loan;
    }

    public function updateStatus()
    {
        $loans = Loan::all();

        foreach($loans as $loan) {

            $today = new \DateTime();
            $dueDate = new \DateTime($loan->ln_due_date);
            $dateDiff = date_diff($dueDate, $today);

            if ($dateDiff->d > 0 && $dateDiff->invert == 1) {
                $loan->ln_status = 0;
            } else if($dateDiff->d == 0) {
                $loan->ln_status = 1;
            } else if($dateDiff->d > 0 && $dateDiff->invert == 0) {
                $loan->ln_status = 2;
            }

            $loan->save();

        }

    }

    public function deleteLoan($id)
    {
        $query = DB::table('loans')
            ->where('ln_id', $id)
            ->delete();

        return $query;
    }
}