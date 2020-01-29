<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class weeklyemail extends Mailable
{
    use Queueable, SerializesModels;

    public $books;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($books)
    {
        $this->books = $books;
    }
    public function build()
    {
        return $this->view('actualreport');
    }
}
