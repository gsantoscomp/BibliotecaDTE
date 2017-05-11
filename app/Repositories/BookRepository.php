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
                    ->orderBy('bk_title')
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
        $book = new Book();

        $book->bk_title = $request->bk_title;
        $book->bk_author = $request->bk_author;
        $book->bk_owner = $request->bk_owner;
        $book->bk_description = $request->bk_description;
        $book->bk_availability = 'disponivel';
        $book->bk_pub_id = $request->bk_pub_id;

        $book->save();

        return $book;
    }

    public function deleteBook($id)
    {
        $query = DB::table('books')
                ->where('bk_id', $id)
                ->delete();

        return $query;
    }

}