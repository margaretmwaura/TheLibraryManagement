<?php

namespace App\Console\Commands;

use App\Mail\duedatesmails;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class sendemails extends Command
{

    protected $signature = 'command:duedatecheck';


    protected $description = 'Command description';


    public function __construct()
    {
        parent::__construct();
    }


    public function handle()
    {
        Log::info("The cron job is being run");
//        Mail::to('mwauramargaret1@gmail.com')->send(new duedatesmails());
        echo "Maggies first job\n";
    }
}
