<?php

namespace App\Repositories;

use DB;

class ClientRepository
{
    public function getAvailableBooks()
    {
        $query = DB::table('books')
                    ->where('bk_availability', 'disponivel')
                    ->get();

        return $query;
    }
}