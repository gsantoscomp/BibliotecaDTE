<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Repositories\BookRepository;
use Illuminate\Http\JsonResponse;

class BookManagementController extends Controller
{
    public function index()
    {
        $bookRepository = new BookRepository();
        $books = $bookRepository->getBook();

        return view('admin.book',[
            'books' => $books
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

    public function destroy($id)
    {

        $bookRepository = new BookRepository();
        $bookRepository->deleteBook($id);

        return;

    }
}
