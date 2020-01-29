<?php

namespace App\Mail;

use App\emaildata;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class duedatesmails extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public $days;
    public function __construct(emaildata $days)
    {
        $this->days = $days;
    }
    public function build()
    {
        return $this->from('mwauramargaret1@gmail.com')
            ->view('dueemail');
    }
}
