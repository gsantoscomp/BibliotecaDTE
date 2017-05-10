<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use App\Repositories\BookRepository;
use Illuminate\Http\JsonResponse;

class BookManagementController extends Controller
{
    public function index()
    {
        $bookRepository = new BookRepository();
        $books = $bookRepository->getBook();
        $publishers = $bookRepository->getPublisher();

        return view('admin.book',[
            'books' => $books,
            'publishers' => $publishers
        ]);
    }

    public function store(BookRequest $request)
    {
        try {

            $bookRepository = new BookRepository();
            $book = $bookRepository->addBook($request);

            return new JsonResponse([$book, 200]);

        } catch(\Exception $e){
            throw $e;
         }
    }

    public function destroy(Book $book)
    {

        $book->delete();

        return new JsonResponse([$book, 200]);

    }
}
