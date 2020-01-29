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

        //return books since sytax has changed
        $books = app('App\Http\Controllers\BooksController')->index();
        Log::info("This is the response after ordering a book " . $books);
        return response()->json($books);
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

        //return books since sytax has changed
        $books = app('App\Http\Controllers\BooksController')->index();
        Log::info("This is the response after reserving a book " . $books);
        return response()->json($books);
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
        $useremail = $request->input("email");
        $due_date = $request->input("due_date");
        Log::info("This is the due date associated with the book " . $due_date);
        Log::info("This is the entire request " , $request->all());
        Log::info("User has returned the book which is " . $bookname . " and its id is ");

        $books = DB::table('books')->where('name', $bookname)->get();
        $users = DB::table('users')->where('email',$useremail)->get();


        Log::info("This is the email of user ". $useremail);

        $book = $books[0];
        $book = Book::find($book->id);
        $book->return_date= Carbon::now();
        $book->save();

        Log::info("The id of the book is " . $book->id);
        $user = $users[0];
        $user = User::find($user->id);
        $id = $user->id;
        Log::info("This is the id of the user " . $id);

        try{
            $book->users()->wherePivot('due_date', $due_date)->updateExistingPivot($id, array('return_date' => Carbon::now()), false);

            $id = $user->id;
            // get an email for a user who had ordered the book
            $books = DB::table('book_user')->where('name', $bookname)->whereNotNull("borrow_date")->get();
            Log::info("These are the books I have gotten from query". $books);
            $book = $books[0];
            Log::info("This is the id of that book ". $book->book_id);
            $book = Book::find($book->book_id);
            $current = Carbon::now();
            $trialExpires = $current->addDays(14);
            $borrowdate = $book->reserve_date;
            Log::info("This is the borrow date " . $borrowdate);
            $book->users()->wherePivot('borrow_date', $borrowdate)->updateExistingPivot($id, array('order_date' => $current,'due_date' => $trialExpires), false);
            $bookcollection =  $data = DB::table('book_user')->select('due_date', 'borrow_date','order_date','return_date','name','email')->get();
            return response()->json($bookcollection);
        }
       catch (\Exception $e)
       {
           Log::info("There was an erro while updating " . $e );
       }


    }
    public function getBooks()
    {
        $user = Auth::user();
        $count = $user->books->count();
        Log::info("These are the number of books linked to the user " . $count);
        return response($count);
    }
}
