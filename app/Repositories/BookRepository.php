<?php

namespace App\Repositories;

use App\Models\Book;
use DB;

class BookRepository
{
    public function getBook()
    {
        $query = DB::table('books')
                    ->join('publishers', 'books.bk_pub_id', 'pub_id')
                    ->select('books.*', 'pub_name', 'pub_id')
                    ->get();

        return $query;
    }

    public function getPublisher()
    {
        $query = DB::table('publishers')
            ->select('pub_id', 'pub_name')
            ->get();

        return $query;
    }

    public function addBook($request)
    {
        $query = Book::create([
            'bk_title' => $request->bk_name,
            'bk_author' => $request->bk_author,
            'bk_owner' => $request->bk_owner,
            'bk_description' => $request->bk_description,
            'bk_availability' => true,
            'bk_pub_id' => $request->bk_pub_id,
        ]);

        return $query;
    }

}