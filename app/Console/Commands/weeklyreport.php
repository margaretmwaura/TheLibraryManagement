<?php

namespace App\Console\Commands;

use App\Mail\duedatesmails;
use App\Mail\weeklyemail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class weeklyreport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:weeklyreport';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $admin=User::where('role_id',9)->get();
        $adminone=$admin[0];
        $adminemail=$adminone->email;
        $bookcollection = DB::table('book_user')->select('due_date', 'borrow_date', 'order_date', 'return_date', 'name', 'email')->get();
        Mail::to('mwauramargaret1@gmail.com')->send(new weeklyemail($bookcollection));
    }
}
