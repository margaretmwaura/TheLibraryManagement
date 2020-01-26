<?php

namespace App\Http\Controllers;

use App\Models\Book;
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
        $book = Book::find($id);
        $current = Carbon::now();
        $trialExpires = $current->addDays(14);
        $book->users()->attach($user_id,['due_date' => Carbon::now(),'order_date' => $trialExpires]);
    }
    public function reservebook(Request $request)
    {
        Log::info("ordering a book " . $request->input("id"));
        Log::info("Currently logged in user " . Auth::user()->id);
        $id = $request->input("id");
        $user_id=Auth::user()->id;
        $book = Book::find($id);
        $book->users()->attach($user_id,['borrow_date' => Carbon::now()]);
    }
}
