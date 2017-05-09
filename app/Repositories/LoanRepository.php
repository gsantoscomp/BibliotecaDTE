<?php

namespace App\Repositories;

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
}