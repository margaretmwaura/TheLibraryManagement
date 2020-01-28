<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BookUsersController extends Controller
{
    //Instead of sending out two objects , the user we will be getting is the current user
    public function orderBook(Request $request)
    {
        Log::info($request->all());
        Log::info("ordering a book " . $request->input("id"));
        Log::info("Currently logged in user " . Auth::user()->id);
        $id = $request->input("id");
        $user_id=Auth::user()->id;
        $email=Auth::user()->email;

        $current = Carbon::now();
        $trialExpires = $current->addDays(14);

        $book = Book::find($id);
        $book->borrow_date=$current;
        $book->due_date=$trialExpires;
        $name = $book->name;

        //Changing status
        $book->status_id=2;
        $book->save();
        $book->users()->attach($user_id,['due_date' => $trialExpires,'order_date' => Carbon::now(),'email'=>$email,'name'=>$name]);
    }
    public function reservebook(Request $request)
    {
        Log::info("ordering a book " . $request->input("id"));
        Log::info("Currently logged in user " . Auth::user()->id);
        $id = $request->input("id");
        $user_id=Auth::user()->id;
        $email=Auth::user()->email;


        $book = Book::find($id);
        $name = $book->name;
        $book->status_id=3;
        $book->reserve_date=Carbon::now();
        $book->save();
        $book->users()->attach($user_id,['borrow_date' => Carbon::now(),'email'=>$email,'name'=>$name]);
    }
    public function getAllBooks()
    {
//        $users = User::all();
        $bookcollection =  $data = DB::table('book_user')->select('due_date', 'borrow_date','order_date','return_date','name','email')->get();;
        return response()->json($bookcollection);
    }
    public function sendingemails()
    {
      $data = DB::table('book_user')->select("due_date","order_date","email")->whereNotNull("due_date")->get();
        try{
            $data->each(function ($item, $key) {
                Log::info("The due date " .$item->due_date);
                Log::info("The order date " . $item->order_date);
                $due = $item->due_date;
                $oder = $item->order_date;
                $due_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i',$due);
                $order_date = \Carbon\Carbon::createFromFormat('Y-m-d H:s:i',$oder);
                $diff = $due_date->diffInDays($order_date);
                Log::info("This is the difference in days " . $diff);
            });
        }
        catch (\Exception $e)
        {
            Log::info("The reasons for not getting the collection " . $e->getMessage());
        }
    }
    public function returnbook(Request $request)
    {
        $bookname = $request->input("name");
        $bookid = $request->input("id");
      Log::info("User has returned the book which is " . $bookname . " and its id is " . $bookid);
      $book = Book::find($bookid);
      $book->return_date= Carbon::now();
      $book->save();
      Log::info("We have tried updating the book");

    }
    public function getBooks()
    {
        $user = Auth::user();
        $count = $user->books->count();
        Log::info("These are the number of books linked to the user " . $count);
        return response($count);
    }
}
