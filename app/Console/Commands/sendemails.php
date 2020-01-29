<?php

namespace App\Console\Commands;

use App\emaildata;
use App\Mail\collectbook;
use App\Mail\duedatesmails;
use App\Mail\hremail;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
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
       $this->sendingemails();

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
                $name = $item->name;
                $email = $item->email;
                $admin = User::where('status',9)->get();
                $adminemail = $admin->email;
                Log::info("This is the difference in days " . $diff);

                if($diff === 3)
                {
                    $day = 3;
                    $emaildits = new emaildata();
                    $emaildits->name = $name;
                    $emaildits->days=$day;
                    Mail::to($email)->send(new duedatesmails($emaildits));
                }
                if($diff === 2)
                {
                    $emaildits = new emaildata();
                    $emaildits->name = $name;
                    $emaildits->days=2;
                    Mail::to($email)->send(new duedatesmails($emaildits));
                }
                if($diff === 1)
                {
                    $emaildits = new emaildata();
                    $emaildits->name = $name;
                    $emaildits->days=1;
                    Mail::to($email)->send(new duedatesmails($emaildits));
                }
                if($diff === -1)
                {
                    $emaildits = new emaildata();
                    $emaildits->name = $name;
                    $emaildits->days=-1;
                    Mail::to($email)->send(new duedatesmails($emaildits));
                }
                if($diff === -2)
                {
                    $emaildits = new emaildata();
                    $emaildits->name = $name;
                    $emaildits->days=-2;
                    Mail::to($email)->send(new duedatesmails($emaildits));
                }
                if($diff === -3)
                {
                    $emaildits = new emaildata();
                    $emaildits->name = $name;
                    $emaildits->days=-3;
                    Mail::to($email)->send(new duedatesmails($emaildits));
                    Mail::to($adminemail)->send(new hremail($email));
                }
            });
        }
        catch (\Exception $e)
        {
            Log::info("The reasons for not getting the collection " . $e->getMessage());
        }
    }
}
