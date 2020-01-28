<?php

namespace App\Http\Controllers;

use App\Repository\Interfaces\BookRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BooksController extends Controller
{

    public $bookRepository;

    public function __construct(BookRepositoryInterface $bookRepository)
    {
        $this->bookRepository = $bookRepository;
    }

    public function index()
    {
        $books = $this->bookRepository->all();
        return response()->json($books);
    }

    public function store(Request $request)
    {

        Log::info("This is the request " . $request);
       $books =  $this->bookRepository->storeRecord($request->all());
        return response()->json($books);
    }

    public function update(Request $request, $id)
    {
        //
        $this->bookRepository->updateRecord($request, $id);
    }

    public function destroy($id)
    {
        $books = $this->bookRepository->deleteRecord($id);
        return response()->json($books);
    }
}
