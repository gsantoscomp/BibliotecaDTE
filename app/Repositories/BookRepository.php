<?php

namespace App\Repositories;

use App\Models\Book;
use DB;

class BookRepository
{
    public function getBook()
    {
        $query = DB::table('books')
                    ->select('books.*')
                    ->orderBy('bk_title')
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
        $book->bk_publisher = $request->bk_publisher;

        $book->save();

        return $book;
    }
    
    public function changeBookAvailability($book_id)
    {
        $book = Book::find($book_id);

        if($book->bk_availability == 'disponivel'){
            $book->bk_availability = 'indisponivel';
        } else {
            $book->bk_availability = 'disponivel';
        }

        $book->save();
    }

    public function deleteBook($id)
    {
        $query = DB::table('books')
                ->where('bk_id', $id)
                ->delete();

        return $query;
    }

}