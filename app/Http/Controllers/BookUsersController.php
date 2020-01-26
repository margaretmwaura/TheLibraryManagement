<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class BookUsersController extends Controller
{
    //Instead of sending out two objects , the user we will be getting is the current user
    public function orderBook(Request $request)
    {
        Log::info("ordering a book " . $request->input("id"));
        Log::info("Currently logged in user " . Auth::user()->id);
        $id = $request->input("id");
        $user_id=Auth::user()->id;

        $current = Carbon::now();
        $trialExpires = $current->addDays(14);

        $book = Book::find($id);
        $book->borrow_date=$current;
        $book->due_date=$trialExpires;

        $book->save();
        $book->users()->attach($user_id,['due_date' => Carbon::now(),'order_date' => $trialExpires]);
    }
    public function reservebook(Request $request)
    {
        Log::info("ordering a book " . $request->input("id"));
        Log::info("Currently logged in user " . Auth::user()->id);
        $id = $request->input("id");
        $user_id=Auth::user()->id;

        $book = Book::find($id);
        $book->reserve_date=Carbon::now();
        $book->save();
        $book->users()->attach($user_id,['borrow_date' => Carbon::now()]);
    }
    public function getAllBooks()
    {
        $users = User::all();
        $bookcollection = collect([]);
        try{
            $users->each(function ($item, $key) use ($bookcollection) {

                Log::info($item->id);
                Log::info($item->books->pluck('name'));
                $bookcollection->push($item->books);
                Log::info($bookcollection);

            });
        }
        catch (\Exception $e)
        {
            Log::info("The reasons for not getting the collection " . $e->getMessage());
        }
        return response()->json($bookcollection);
    }
}
