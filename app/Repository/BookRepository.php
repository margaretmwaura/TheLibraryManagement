<?php


namespace App\Repository;


use App\Models\Book;
use App\Repository\Interfaces\BookRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class BookRepository implements BookRepositoryInterface
{
    public function all()
    {
       return Book::all();
    }

    public function storeRecord($input)
    {
        return Book::create($input);

    }

    public function deleteRecord($id)
    {
        $book = Book::find($id);
        Log::info("Data to be deleted " . $id);
        $book->delete();
    }

    public function updateRecord(Request $request, $id)
    {
        $book = Book::find($id);
       $book->update($request->all());

//
        try {
            $book->setTile($request->input('title'));
            $book->setMessage($request->input('message'));
            $book->setDate(\Carbon\Carbon::now());

            $book->save();
            Log::info("Data has been saved");
        } catch (\Exception $exception) {
            Log::info("An error was encounterd" . $exception->getMessage());
        }
    }
}
