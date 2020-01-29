<?php

namespace App\Http\Controllers;

use App\Mail\weeklyemail;
use Barryvdh\DomPDF\PDF as PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class PdfController extends Controller
{
    //
    public function index()
    {

        $books=DB::table('book_user')->select('due_date', 'borrow_date', 'order_date', 'return_date', 'name', 'email')->get();
        return view('actualreport')->with('books', $books);
    }

    public function downloadPDF()
    {

        $books=DB::table('book_user')
            ->select('due_date', 'borrow_date', 'order_date', 'return_date', 'name', 'email')->get()->toArray();
        $pdf = \PDF::loadView('pdf-view', ['data' => $books])->stream();

        return $pdf;

    }
}
